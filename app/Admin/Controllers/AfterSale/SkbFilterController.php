<?php

namespace App\Admin\Controllers\AfterSale;

use App\Models\AfterSale\SkbFilterModel;
use App\Models\AfterSale\SkbFilterLevelModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbFilterController extends Controller
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

            $content->header('滤芯列表');
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
        return Admin::grid(SkbFilterModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->level_id('滤芯级数')->display(function ($level_id) {
                return SkbFilterLevelModel::find($level_id)->title;
            });
            $grid->filter_name('滤芯名称');
            $grid->filter_model('产品型号');
            $grid->filter_life('滤芯寿命')->display(function($filter_life) {
                return $filter_life.'个月';
            })->sortable();

            $grid->filter( function ($filter) {

                $filter->disableIdFilter();

                $filter->like('filter_name', '滤芯名称');
                $filter->like('filter_model', '滤芯品名');
            });

            $grid->disableExport();

            $grid->created_at('添加时间');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbFilterModel::class, function (Form $form) {

            $form->select('level_id', '滤芯级数')
                 ->options(SkbFilterLevelModel::all()
                 ->pluck('title', 'id'));

            $form->text('filter_name', '滤芯名称');
            $form->text('filter_model', '滤芯品名');
            $form->number('filter_life', '滤芯寿命');

        });
    }
}
