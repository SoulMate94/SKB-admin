<?php

namespace App\Admin\Controllers\AfterSale;

use App\Models\AfterSale\SkbCleanTypeModel;
use App\Models\AfterSale\SkbFilterModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbCleanTypeController extends Controller
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

            $content->header('净水器机型');
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
        return Admin::grid(SkbCleanTypeModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->product_name('名称');
            $grid->product_img('图片')->image('', 100, 100);
            $grid->level_1('第一级');
            $grid->level_2('第二级');
            $grid->level_3('第三级');
            $grid->level_4('第四级');
            $grid->level_5('第五级');

            $grid->created_at('添加时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {
                $filter->like('product_name', '名称');
                $filter->like('level_1', '第一级');
                $filter->like('level_2', '第二级');
                $filter->like('level_3', '第三级');
                $filter->like('level_4', '第四级');
                $filter->like('level_5', '第五级');
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
        return Admin::form(SkbCleanTypeModel::class, function (Form $form) {

            $form->text('product_name', '产品名称');
            $form->image('product_img', '产品图片');

            $form->select('level_1', '第一级')
                 ->options(SkbFilterModel::all()
                 ->where('level_id', 1)
                 ->pluck('filter_name', 'filter_name'));

            $form->select('level_2', '第二级')
                 ->options(SkbFilterModel::all()
                 ->where('level_id', 2)
                 ->pluck('filter_name', 'filter_name'));

            $form->select('level_3', '第三级')
                 ->options(SkbFilterModel::all()
                 ->where('level_id', 3)
                 ->pluck('filter_name', 'filter_name'));

            $form->select('level_4', '第四级')
                 ->options(SkbFilterModel::all()
                 ->where('level_id', 4)
                 ->pluck('filter_name', 'filter_name'));

            $form->select('level_5', '第五级')
                 ->options(SkbFilterModel::all()
                 ->where('level_id', 5)
                 ->pluck('filter_name', 'filter_name'));

        });
    }
}
