<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbAddressModel;
use App\Models\SKB\Common\SkbOrdersModel;

use App\Models\SKB\Master\SkbServiceCateModel;
use App\Models\SkbUsersModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbOrdersController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('订单列表');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新增');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(SkbOrdersModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->order_number('订单编号')->label('success');
            $grid->uid('下单用户')->display(function ($uid) {
                return SkbUsersModel::find($uid)->username;
            })->prependIcon('user');
            $grid->mid('接单师傅')->display(function ($mid) {
                return SkbUsersModel::find($mid)->username;
            })->prependIcon('user-secret');

            $grid->service_id('服务类别')->display(function ($service_id) {
                $dat = explode(',', $service_id);
                $res = '<span class="label label-info">';
                foreach ($dat as $v) {
                    $res .= SkbServiceCateModel::select('title')
                            ->where([
                                ['id', $v],
                                ['is_active', 1]
                            ])
                            ->first()['title'].'</span>&nbsp;&nbsp;<span class="label label-info">';
                }
                $res .= '</span>';
                return rtrim($res, '--');
            });


            $grid->order_status('订单状态')->display(function ($status) {
                switch ($status) {
                    case -1:
                        return '<span class="label label-danger">已取消</span>';
                    case 0 :
                        return '<span class="label label-info">待接单</span>';
                    case 1 :
                        return '<span class="label label-success">已接单</span>';
                    case 2 :
                        return '<span class="label label-warning">待支付</span>';
                    case 3 :
                        return '<span class="label label-success">已支付</span>';
                    case 8 :
                        return '<span class="label label-success">已完成</span>';
                    case -8:
                        return '<span class="label label-danger">已撤单</span>';
                    default :
                        return '<span class="label label-info">订单异常</span>';
                }
            });

            $grid->product_info('订单信息')->display(function () {
                return "<span class='label label-default'>
                            <a href='/admin/skb_order/{$this->id}/edit'>点击查看详情</a>
                        </span>";
            });

            $grid->total_price('订单总额')->display(function ($total_price) {
                return $total_price.'元';
            })->prependIcon('rmb');
            $grid->visit_cost('订单总额')->display(function ($visit_cost) {
                return $visit_cost.'元';
            })->prependIcon('rmb');

            $grid->end_addr('安装地点')->display(function ($end_addr) {
                return SkbAddressModel::find($end_addr)->area.
                       SkbAddressModel::find($end_addr)->addr;
            })->label('default');

            $grid->orderby('排序')->label('primary')->sortable();

            $grid->order_remarks('订单备注')->display(function ($order_remarks) {
                return $order_remarks ?? '暂无备注';
            })->limit(20);

            $grid->appoint_time('预约时间')->sortable();

            $grid->created_at('创建时间');

            $grid->disableCreateButton();
            $grid->disableExport();

            $grid->filter( function ($filter) {

                $filter->disableIDFilter();

                $filter->like('order_number', '订单编号');
                $filter->like('skb_user.username', '下单用户');
                $filter->like('skb_master.username', '接单师傅');
                $filter->like('order_remarks', '订单备注');
                
                $filter->where(function ($query) {
                    $query->where('appoint_time', '>=', strtotime($this->input.' 00:00:00'));
                }, '预约时间开始')->date();

                $filter->where(function ($query) {
                    $query->where('appoint_time', '<=', strtotime($this->input.' 23:59:59'));
                }, '预约时间结束')->date();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbOrdersModel::class, function (Form $form) {

            $form->display('order_number', '订单编号');

            $form->select('order_status','订单状态')
                 ->options([
                    '-1' => '已取消',
                    '0'  => '待接单',
                    '1'  => '已接单',
                    '2'  => '待支付',
                    '3'  => '已支付',
                    '8'  => '已完成',
                    '-8' => '已撤单'
                 ])
                 ->attribute('id', 'order_status');

            $form->display('uid', '下单用户')
                 ->with(function ($uid) {
                     return SkbUsersModel::select('username')
                             ->where([
                                 ['id', $uid],
                                 ['is_del', 0]
                             ])
                            ->first()['username'];
                 });

            $form->display('mid', '接单师傅')
                 ->with(function ($mid) {
                    return SkbUsersModel::select('username')
                        ->where([
                            ['id', $mid],
                            ['role', '>',1],
                            ['is_del', 0]
                        ])
                        ->first()['username'];
                });

            $form->display('end_addr', '目的地')
                 ->with(function ($end_addr) {
                     return SkbAddressModel::find($end_addr)->area.
                            SkbAddressModel::find($end_addr)->addr;
                 });

            $form->display('service_id', '服务类别')
                 ->with(function ($data) {
                     $data = explode(',', $data);
                     $res  = '';
                     foreach ($data as $v){
                        $res .= SkbServiceCateModel::select('title')
                                ->where([
                                    ['id', $v],
                                    ['is_active', 1]
                                ])
                                ->first()['title'].'--';
                     }
                    return rtrim($res, '--');
                 });

            $form->divide();

            // TODO
            $form->embeds('product_info', '订单详情', function ($form) {
                $form->display('product_id', '商品ID');
                $form->number('product_num', '商品数量');
                $form->textarea('product_remarks', '商品备注');
            });

            // 自定义标题
            $form->embeds('product_info', '订单详情', function ($form) {

                $form->display(0, '商品1')->with( function ($data) {
                    if (!$data) return false;

                    //$product_info    = SkbProductModel::where('id', $data['product_id'])->first();
                    $product_info    = $data['product_id'];;
                    $product_num     = $data['product_num'];
                    $product_remarks = $data['product_remarks'];

                    return $product_info.'--'.$product_num.'--'.$product_remarks;
                });

                $form->display(1, '商品2')->with( function ($data) {
                    if (!$data) return false;

                    //$product_info    = SkbProductModel::where('id', $data['product_id'])->first();
                    $product_info    = $data['product_id'];;
                    $product_num     = $data['product_num'];
                    $product_remarks = $data['product_remarks'];

                    return $product_info.'--'.$product_num.'--'.$product_remarks;
                });

                $form->display(2, '商品3')->with( function ($data) {
                    if (!$data) return false;

                    //$product_info    = SkbProductModel::where('id', $data['product_id'])->first();
                    $product_info    = $data['product_id'];;
                    $product_num     = $data['product_num'];
                    $product_remarks = $data['product_remarks'];

                    return $product_info.'--'.$product_num.'--'.$product_remarks;
                });

            });

            $form->currency('total_price', '订单总额')->symbol('￥');
            $form->currency('visit_cost', '上门费')->symbol('￥');

            $form->datetime('appoint_time', '预约时间');

            $form->textarea('order_remarks', '订单备注');

            $form->display('created_at', '订单创建时间');

            $form->saving(function (Form $form) {
                $form->datetime = strtotime($form->datetime);
            });

            $form->ignore('product_info');
        });
    }

    public function getUserName()
    {
        return SkbUsersModel::select(['id', 'username as text'])->where('is_del', 0)->get()->toArray();
    }
}
