<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbProductCateModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbProductCateController extends Controller
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

            $content->header('产品类别');
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
        return Admin::grid(SkbProductCateModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('产品类别')->label('info');

            $is_active = [
                'on'  => ['value' => 1, 'text' => '激活', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];
            $grid->is_active('是否激活')->switch($is_active);

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
        return Admin::form(SkbProductCateModel::class, function (Form $form) {


            $form->text('title', '产品类别名称');

            $is_active = [
                'on'  => ['value' => 1, 'text' => '激活', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];
            $form->switch('is_active', '是否激活')
                 ->states($is_active)
                 ->default(1);

        });
    }
}
