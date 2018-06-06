<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbTagsCateModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbTagsCateController extends Controller
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

            $content->header('标签分类');
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
        return Admin::grid(SkbTagsCateModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('分类标题')->label('success');

            $is_active = [
                'on'  => ['value' => 1, 'text' => '开启', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];

            $grid->is_active('是否开启')->switch($is_active);

            $grid->created_at('创建时间');

            $grid->disableExport();

            $grid->filter(function($filter) {
                $filter->disableIDFilter();

                $filter->like('title', '分类标题');
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
        return Admin::form(SkbTagsCateModel::class, function (Form $form) {

            $form->text('title', '分类标题');

            $is_active = [
                'on'  => ['value' => 1, 'text' => '开启', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];
            $form->switch('is_active', '是否激活')->states($is_active)->default(1);
        });
    }
}
