<?php

namespace App\Admin\Controllers\SKJ;

use App\Models\SKJ\SkjManageSolutionModel;
use App\Models\SKB\Common\SkbArticleCateModel;
use App\Models\SKj\SkjManageProvideSolutionModel;
use App\Admin\Extensions\CheckRow;

use Encore\Admin\Form;
use Encore\Admin\Grid;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkjManageSolutionController extends Controller
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

            $content->header('水质管理解决方案');
            $content->description('水可净');

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

            $content->header('水质管理解决方案');
            $content->description('水可净');

            $content->body($this->form()->edit($id));
        });
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('水质管理解决方案');
            $content->description('水可净');

            $content->body($this->showPage()->view($id));
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

            $content->header('水质管理解决方案');
            $content->description('水可净');

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
        return Admin::grid(SkjManageSolutionModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->tds('TDS值')->sortable();
            $grid->ph('PH值')->sortable();
            $grid->bathroom_products('卫浴产品');
            $grid->solution('工程部回复');
            $grid->install_time('施工日期')->sortable();
            $grid->actions(function ($actions) {
                $actions->append(new CheckRow($actions->getKey()));
            });
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
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
        return Admin::form(SkjManageSolutionModel::class, function (Form $form) {

//            $form->display('id', 'ID');
            $form->number('tds','TDS值');
            $form->number('ph','PH值');
            $form->text('water_quality','水质情况');
            $form->text('water_way','水路评测');
            $form->text('water_pipe','水管现状');
            $form->text('bathroom_products','卫浴产品');
            $form->textarea('overall_water_quality','整体水质管理情况概述');
            $form->textarea('water_quality_suggestion','专业饮用水质管理建议');
            $form->text('user_demand','用户需求');
            $form->hasMany('has_many_provide','解决方案', function (Form\NestedForm $form) {
                $form->text('product','产品');
                $form->text('features','功能');
                $form->number('quantity','数量');
                $form->currency('unit','单价')->symbol('&yen;');
                $form->currency('price','报价')->symbol('&yen;');
            });
            $form->divide();
            $form->number('y_tds','预估改善后的TDS值');
            $form->number('y_ph','预估改善后的PH值');
            $form->text('y_water_quality','预估改善后的水质情况');
            $form->text('y_water_way','预估改善后的水路评测');
            $form->text('y_water_pipe','预估改善后的水管现状');
            $form->text('y_bathroom_products','预估维修后的的卫浴产品');

            $form->divide();
            $form->datetime('install_time','施工日期')->format('YYYY-MM-DD');
            $form->textarea('solution','工程部回复');

            $form->saving(function (Form $form) {
                $form->install_time=strtotime($form->install_time);
            });


//            $form->display('created_at', 'Created At');
//            $form->display('updated_at', 'Updated At');
        });
    }

    protected function showPage()
    {
        return Admin::form(SkjManageSolutionModel::class, function (Form $form) {

            $form->tab('调查结果', function ($form) {
                $form->display('id', 'ID');
                $form->display('tds','TDS值');
                $form->display('ph','PH值');
                $form->display('water_quality','水质情况');
                $form->display('water_way','水路评测');
                $form->display('water_pipe','水管现状');
                $form->display('bathroom_products','卫浴产品');
                $form->display('overall_water_quality','整体水质管理情况概述');
                $form->display('water_quality_suggestion','专业饮用水质管理建议');
                $form->display('user_demand','用户需求');

            })->tab('解决方案', function ($form) {
                $form->hasMany('has_many_provide','', function (Form\NestedForm $form) {
                    $form->display('product','产品');
                    $form->display('features','功能');
                    $form->display('quantity','数量');
                    $form->currency('unit','单价')->symbol('&yen;');
                    $form->currency('price','报价')->symbol('&yen;');
                });

            })->tab('预估效果', function ($form) {
                $form->display('y_tds','TDS值');
                $form->display('y_ph','PH值');
                $form->display('y_water_quality','水质情况');
                $form->display('y_water_way','水路评测');
                $form->display('y_water_pipe','水管现状');
                $form->display('y_bathroom_products','卫浴产品');
            })->tab('工程部', function ($form) {
                $form->datetime('install_time','施工日期')->format('YYYY-MM-DD');
                $form->display('solution','回复');

            });
        });
    }
}
