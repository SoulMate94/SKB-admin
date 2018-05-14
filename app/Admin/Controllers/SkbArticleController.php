<?php

namespace App\Admin\Controllers;

use App\Models\SkbArticleModel;
use App\Models\SkbArticleCateModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbArticleController extends Controller
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

            $content->header('水可邦文章列表');
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
        return Admin::grid(SkbArticleModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->cate_id('所属分类')->display(function ($cate_id) {
                return SkbArticleCateModel::find($cate_id)->title;
            });
            $grid->title('文章标题')->editable();
            $grid->content('文章内容')->limit(30);
            $grid->author('文章作者');

            $is_top = [
                'on'  => ['value' => 1, 'text' => '已置顶', 'color' => 'primary'],
                'off' => ['value' => 2, 'text' => '未置顶', 'color' => 'default'],
            ];
            $grid->is_top('是否置顶')->switch($is_top);

            $is_release = [
                'on'  => ['value' => 1, 'text' => '已发布', 'color' => 'primary'],
                'off' => ['value' => 2, 'text' => '未发布', 'color' => 'default'],
            ];
            $grid->is_release('是否发布')->switch($is_release);

            $grid->order('排序')->sortable()->editable();

            $grid->filter(function ($filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                $filter->like('title', '文章标题');
                $filter->like('content', '文章内容');
                $filter->like('author', '文章作者');
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
        return Admin::form(SkbArticleModel::class, function (Form $form) {

            // $form->display('id', 'ID');

            $form->select('cate_id', '所属分类')
                 ->options(SkbArticleCateModel::all()
                 ->pluck('title', 'id'));

            $form->text('title', '文章标题');
            $form->text('author', '文章作者');
            $form->number('order', '文章排序');

            $is_top = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 2, 'text' => '否', 'color' => 'default'],
            ];
            $form->switch('is_top', '是否置顶')->states($is_top);

            $is_release = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 2, 'text' => '否', 'color' => 'default'],
            ];
            $form->switch('is_release', '是否发布')->states($is_release);

            $form->textarea('content', '内容');

        });
    }
}
