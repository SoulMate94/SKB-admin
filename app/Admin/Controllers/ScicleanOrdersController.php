<?php

namespace App\Admin\Controllers;

use App\Models\ScicleanOrdersModel;
use App\Models\ScicleanPriceModel;
use App\Models\ScicleanCatesModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ScicleanOrdersController extends Controller
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

            $content->header('净水器订单列表');
            $content->description('');

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

            $content->header('新增 ');
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
        return Admin::grid(ScicleanOrdersModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->order_number('订单编号');
            $grid->product_name('产品名称');
            $grid->product_model('产品型号')->display(function ($product_model) {
                return ScicleanPriceModel::find($product_model)->product_name;
            });


            $grid->consignee_name('收货人姓名')->color('green');
            $grid->consignee_tel('收货人手机号码')->prependIcon('phone');
            $grid->consignee_addr('收货人地址');
            $grid->sale_price('结算价')->sortable();
            $grid->sale_number('销售数量')->sortable();

            $grid->proxy_type('代理类型')->editable('select', [
                1 => '个人代理',
                2 => '代理商代理',
                3 => '团队代理'
            ]);

            $grid->trading_status('交易状态')->editable('select', [
                1  => '代付款',
                2  => '已收款',
                3  => '已结算',
                4  => '待发货',
                5  => '已备货',
                6  => '备货中',
                7  => '备货成功',
                8  => '备货失败',
                9  => '已发货',
                10 => '已签收',
                11 => '退货中',
                12 => '已退款',
                13 => '已取消'
            ]);

            $grid->kuaidi_number('快递单号')->display(function ($kuaidi_number) {
                return $kuaidi_number ?: '暂无快递单号';
            });
            $grid->consignee_time('签收时间')->display(function ($consignee_time) {
                return $consignee_time ?: '暂未签收';
            });
            $grid->return_time('退货时间')->display(function ($return_time) {
                return $return_time ?: '暂无退货时间';
            });
            $grid->salesperson('销售员姓名');
            $grid->remarks('备注')->display(function ($remarks) {
                return $remarks ?: '暂无备注';
            })->editable();

            $grid->created_at('订单创建时间')->sortable();
            // $grid->updated_at();

            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                $filter->like('order_number', '订单编号');
                $filter->like('product_name', '产品名称');
                $filter->like('proxy_type', '代理类型');
                $filter->like('product_model', '产品型号');

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
        return Admin::form(ScicleanOrdersModel::class, function (Form $form) {

            $rand = mt_rand(1000,9999);
            $orderNumber = date('ymdHis').$rand;
            $form->hidden('order_number', '订单编号')->value($orderNumber);


            // 产品名称 (即产品分类)
            $form->select('product_name', '产品名称')
                 ->options(ScicleanCatesModel::all()
                 ->pluck('cate_name', 'cate_name'));

            // 产品型号
            $form->select('product_model', '产品型号')
                 ->options(ScicleanPriceModel::all()
                 ->pluck('product_name','id'));

            $form->text('consignee_name', '收货人姓名');
            $form->mobile('consignee_tel', '收货人手机号码');
            $form->text('consignee_addr', '收货人地址');
            $form->currency('sale_price', '结算价格')->symbol('￥');
            $form->number('sale_number', '销售数量');

            $ProxyType = [
                1  => '个人代理',
                2  => '代理商代理',
                3  => '代理商代理2',
            ];
            $form->select('proxy_type', '代理类型')->options($ProxyType);

            $TradingStatus = [
                1  => '代付款',
                2  => '已收款',
                3  => '已结算',
                4  => '待发货',
                5  => '已备货',
                6  => '备货中',
                7  => '备货成功',
                8  => '备货失败',
                9  => '已发货',
                10 => '已签收',
                11 => '退货中',
                12 => '已退款',
                13 => '已取消'
            ];
            $form->select('trading_status', '交易状态')
                 ->options($TradingStatus);

            $form->text('salesperson', '销售员姓名');
            $form->textarea('remarks', '备注');

            // $form->display('created_at', '订单创建时间');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
