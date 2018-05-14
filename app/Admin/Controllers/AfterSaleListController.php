<?php

namespace App\Admin\Controllers;

use App\Models\AfterSaleListModel;
use App\Models\SkbFilterModel;
use App\Models\SkbServiceCateModel;
use App\Models\SkbCleanTypeModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Extensions\ClickRow;
use App\Extensions\ExcelExporter;
use App\Extensions\CustomExporter;
use App\Models\Schedule\UpdateReplaceTime;

class AfterSaleListController extends Controller
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

            $content->header('售后服务申请列表');
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

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            $content->description('description');

            $content->body($this->showPage()->view($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(AfterSaleListModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->apply_name('用户名')->display(function ($apply_name) {
                return "<a  href='/admin/after_sale_list/{$this->id}/show' style=\"color: #999;\">$apply_name</a>";
            })->prependIcon('user md');

            $grid->apply_mobile('手机号码')->prependIcon('phone');
            $grid->apply_addr('地址')->prependIcon('paper-plane-o');
            $grid->service_type('售后类型')->label('primary');

            $grid->column('skb_service_cate_model.title', '服务类别')->label('success');
            $grid->column('skb_clean_type_model.product_name', '净水器机型')->label('info');

            $grid->filter_level_1('一级滤芯');
            $grid->filter_level_2('二级滤芯');
            $grid->filter_level_3('三级滤芯');
            $grid->filter_level_4('四级滤芯');
            $grid->filter_level_5('五级滤芯');
            // $grid->filter_pre('前置滤芯');

//            $grid->service_master_id('服务师傅')->display(function ($service_master_id) {
//                return SkbMasterModel::find($service_master_id)->title;
//            });

            $grid->remark('备注')->display(function ($remark) {
                return $remark ?? '暂无备注';
            });

             $grid->after_sale_countdown('需要更换的滤芯')->display(function () {

                 $res = '';

                 if ($this->filter_level_1_countdown == 0) {
                     $res = '第一级:'.$this->filter_level_1.'<br>';
                 }

                 if ($this->filter_level_2_countdown == 0) {
                     $res .= '第二级:'.$this->filter_level_2.'<br>';
                 }

                 if ($this->filter_level_3_countdown == 0) {
                     $res .= '第三级:'.$this->filter_level_3.'<br>';
                 }

                 if ($this->filter_level_4_time == 0) {
                     $res .= '第四级:'.$this->filter_level_4.'<br>';
                 }

                 if ($this->filter_level_5_countdown == 0) {
                     $res .= '第五级:'.$this->filter_level_5;
                 }

                 return $res
                     ? '<span class="label label-danger">'."$res".'</span>'
                     : '<span class="label label-default">无需更换</span>';
             });

            $grid->created_at('添加时间');


            // 查询
            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                $filter->like('apply_name', '用户名');
                $filter->like('apply_mobile', '用户手机号');
                $filter->like('service_master_id', '师傅姓名');
                $filter->like('remark', '备注');
            });

            // 点击查看详情
            $grid->actions(function ($actions) {
                $actions->append(new ClickRow($actions->getKey()));
            });

            // 导出
            $title  = [
                'ID', '申请人', '手机号码', '地址', '售后类型', '服务类别', '净水器机型',
                '一级滤芯', '二级滤芯', '三级滤芯', '四级滤芯', '五级滤芯',
            ];
            $fields = [
                'id', 'apply_name', 'apply_mobile','apply_addr',
                'service_type','skb_service_cate_model.title', 'skb_clean_type_model.product_name',
                'filter_level_1', 'filter_level_2', 'filter_level_3', 'filter_level_4', 'filter_level_5'
            ];

            $excel = new ExcelExporter('售后服务', $title, $fields);
            $grid->exporter($excel);

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(AfterSaleListModel::class, function (Form $form) {


            $form->tab('基础信息', function (Form $form) {

                $form->text('apply_name', '用户名');
                $form->mobile('apply_mobile', '手机号码')
                     ->options(['mask' => '999 9999 9999']);

                $form->text('apply_addr', '地址');

                $ServiceType = [
                    '滤芯售后'       => '滤芯售后',
                    '不锈钢水管售后'  => '不锈钢水管售后',
                ];
                $form->select('service_type', '售后类型')
                     ->options($ServiceType);

                $form->select('service_cate_id', '服务类别')
                     ->options(SkbServiceCateModel::all()
                     ->pluck('title', 'id'));

                $form->select('clean_type_id', '净水器机型')
                     ->options(SkbCleanTypeModel::all()
                     ->pluck('product_name', 'id'))
                     ->help('选机型后可不选择滤芯');

//                $form->select('skb_master', '服务师傅')
//                     ->options(SkbMasterModel::all()
//                     ->pluck('username', 'id'));

                $form->textarea('remark', '备注');

            })->tab('一级滤芯', function (Form $form) {

                $form->select('filter_level_1', '一级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 1)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_1_time', '滤芯更换时间')
                     ->help('单位(月)')
                     ->default('3');
                $form->display('filter_level_1_countdown', '滤芯更换倒计时')
                     ->help('单位(天), 不需要填写, 自动生成');

            })->tab('二级滤芯', function (Form $form) {

                $form->select('filter_level_2', '二级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 2)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_2_time', '滤芯更换时间')
                     ->help('单位(月)')
                     ->default('6');
                $form->display('filter_level_2_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('三级滤芯', function (Form $form) {

                $form->select('filter_level_3', '三级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 3)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_3_time', '滤芯更换时间')
                     ->help('单位(月)')
                     ->default('6');
                $form->display('filter_level_3_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('四级滤芯', function (Form $form) {

                $form->select('filter_level_4', '四级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 4)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_4_time', '滤芯更换时间')
                     ->help('单位(月)')
                     ->default('24');
                $form->display('filter_level_4_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('五级滤芯', function (Form $form) {

                $form->select('filter_level_5', '五级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 5)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_5_time', '滤芯更换时间')
                     ->help('单位(月)')
                     ->default('12');
                $form->display('filter_level_5_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            });

            $form->saving(function (Form $form) {
                $form->filter_level_1_countdown = $form->filter_level_1_time * 30;
                $form->filter_level_2_countdown = $form->filter_level_2_time * 30;
                $form->filter_level_3_countdown = $form->filter_level_3_time * 30;
                $form->filter_level_4_countdown = $form->filter_level_4_time * 30;
                $form->filter_level_5_countdown = $form->filter_level_5_time * 30;
            });
        });
    }

    protected function showPage()
    {
        return Admin::form(AfterSaleListModel::class, function (Form $form) {


            $form->tab('基础信息', function (Form $form) {

                $form->display('apply_name', '用户名');
                $form->mobile('apply_mobile', '手机号码')
                     ->options(['mask' => '999 9999 9999']);
                $form->display('apply_addr', '地址');
                $ServiceType = [
                    1  => '滤芯售后',
                    2  => '不锈钢水管售后',
                ];
                $form->select('service_type', '服务类型')
                     ->options($ServiceType);

                $form->select('service_cate_id', '服务类别')
                     ->options(SkbServiceCateModel::all()
                     ->pluck('title', 'id'));

                $form->select('clean_type_id', '净水器机型')
                     ->options(SkbCleanTypeModel::all()
                     ->pluck('product_name', 'id'));

//                $form->select('skb_master', '服务师傅')
//                     ->options(SkbMasterModel::all()
//                     ->pluck('username', 'id'));

                $form->display('remark', '备注');

            })->tab('一级滤芯', function (Form $form) {

                $form->select('filter_level_1', '一级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 1)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_1_time', '滤芯更换时间')->help('单位(月)');
                $form->display('filter_level_1_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('二级滤芯', function (Form $form) {

                $form->select('filter_level_2', '二级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 2)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_2_time', '滤芯更换时间')->help('单位(月)');
                $form->display('filter_level_2_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('三级滤芯', function (Form $form) {

                $form->select('filter_level_3', '三级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 3)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_3_time', '滤芯更换时间')->help('单位(月)');
                $form->display('filter_level_3_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('四级滤芯', function (Form $form) {

                $form->select('filter_level_4', '四级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 4)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_4_time', '滤芯更换时间')->help('单位(月)');
                $form->display('filter_level_4_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            })->tab('五级滤芯', function (Form $form) {

                $form->select('filter_level_5', '五级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 5)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_5_time', '滤芯更换时间')->help('单位(月)');
                $form->display('filter_level_5_countdown', '滤芯更换倒计时')
                     ->help('单位(天)');

            });

            $form->disableSubmit();
            $form->disableReset();

            $form->tools(function (Form\Tools $tools) {

                // 去掉返回按钮
                $tools->disableBackButton();

                // 去掉跳转列表按钮
                $tools->disableListButton();

                $tools->add('<a class="btn btn-sm btn-default" href="/admin/after_sale_list"><i class="fa fa-list"></i>&nbsp;&nbsp;列表</a>');
            });
        });
    }
}
