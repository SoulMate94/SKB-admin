<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbTagsCateModel;
use App\Models\SKB\Common\SkbTagsListModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbTagsListController extends Controller
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

            $content->header('标签列表');
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
        return Admin::grid(SkbTagsListModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->cate_id('所属分类')->display(function($cate_id) {
                return SkbTagsCateModel::find($cate_id)->title;
            })->label('success');

            $grid->tags('标签')->display(function ($tags) {
                $tags = explode('/', $tags);

                $res  = '';
                foreach ($tags as $tag) {
                    $res .= '<span class="label label-primary">'.$tag.'</span>'.PHP_EOL;
                }

                return $res;
            });

            $grid->created_at('添加时间');

            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbTagsListModel::class, function (Form $form) {

            $form->select('cate_id', '所属分类')
                 ->options(SkbTagsCateModel::all()
                 ->pluck('title', 'id'));

            $form->textarea('tags', '标签')
                 ->help('以`/`分隔标签');
        });
    }
}
