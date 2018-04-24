<?php

namespace App\Admin\Controllers;

use App\Models\AfterSaleListModel;
use App\Models\SkbFilterModel;
use App\Models\SkbServiceCateModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

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

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(AfterSaleListModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->apply_name('用户名');
            $grid->apply_mobile('手机号码')->prependIcon('phone');
            $grid->apply_addr('地址');
            $grid->service_type('服务类型')->display(function ($service_type) {
                return $service_type == 1
                    ? '滤芯售后'
                    : '不锈钢水管售后';
            });
            $grid->service_cate_id('服务类别')->display(function ($service_cate_id) {
                return SkbServiceCateModel::find($service_cate_id)->title;
            });

            $grid->filter_level_1('一级滤芯');
            $grid->filter_level_2('二级滤芯');
            $grid->filter_level_3('三级滤芯');
            $grid->filter_level_4('四级滤芯');
            $grid->filter_level_5('五级滤芯');
            $grid->filter_pre('前置滤芯');

//            $grid->service_master_id('服务师傅')->display(function ($service_master_id) {
//                return SkbMasterModel::find($service_master_id)->title;
//            });


            $grid->remark('备注')->display(function () {
                return '暂无备注';
            });

            $grid->after_sale_countdown('滤芯倒计时');

            $grid->created_at('添加时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                $filter->like('apply_name', '用户名');
                $filter->like('apply_mobile', '用户手机号');
                $filter->like('service_master_id', '师傅姓名');
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
//        return Admin::form(AfterSaleListModel::class, function (Form $form) {
//
//            $form->display('id', 'ID');
//
//            $form->text('apply_name', '用户名');
//        });

        return Admin::form(AfterSaleListModel::class, function (Form $form) {


            $form->tab('基础信息', function (Form $form) {

                // $form->display('id', 'ID');

                $form->text('apply_name', '用户名');
                $form->mobile('apply_mobile', '手机号码')
                     ->options(['mask' => '999 9999 9999']);
                $form->text('apply_addr', '地址');
                $ServiceType = [
                    1  => '滤芯售后',
                    2  => '不锈钢水管售后',
                ];
                $form->select('service_type', '服务类型')
                     ->options($ServiceType);

                $form->select('service_cate_id', '服务类别')
                     ->options(SkbServiceCateModel::all()
                     ->pluck('title', 'id'));

//                $form->select('skb_master', '服务师傅')
//                     ->options(SkbMasterModel::all()
//                     ->pluck('username', 'id'));

                $form->textarea('remark', '备注');

            })->tab('一级滤芯', function (Form $form) {

                $form->select('filter_level_1', '一级滤芯名称')
                     ->options(SkbFilterModel::all()
                     ->where('level_id', 1)
                     ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_1_time', '滤芯更换时间(单位月)');

            })->tab('二级滤芯', function (Form $form) {

                $form->select('filter_level_2', '二级滤芯名称')
                        ->options(SkbFilterModel::all()
                        ->where('level_id', 2)
                        ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_2_time', '滤芯更换时间(单位月)');

            })->tab('三级滤芯', function (Form $form) {

                $form->select('filter_level_3', '三级滤芯名称')
                        ->options(SkbFilterModel::all()
                        ->where('level_id', 3)
                        ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_3_time', '滤芯更换时间(单位月)');

            })->tab('四级滤芯', function (Form $form) {

                $form->select('filter_level_4', '四级滤芯名称')
                        ->options(SkbFilterModel::all()
                        ->where('level_id', 4)
                        ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_4_time', '滤芯更换时间(单位月)');

            })->tab('五级滤芯', function (Form $form) {

                $form->select('filter_level_5', '五级滤芯名称')
                        ->options(SkbFilterModel::all()
                        ->where('level_id', 5)
                        ->pluck('filter_name', 'filter_name'));
                $form->number('filter_level_5_time', '滤芯更换时间(单位月)');

            });
        });
    }
}
