<?php

namespace App\Admin\Controllers\SKB\User;

use App\Models\SKB\User\SkbCommentModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbCommentController extends Controller
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

            $content->header('评论管理');
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
        return Admin::grid(SkbCommentModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->order_id('订单ID')->label('success');

            $grid->user_cmt('用户评论')->limit(30);
            $grid->user_score('用户评分')->display(function ($user_score) {
                $html = "<i class='fa fa-star' style='color:#ff8913'></i>";

                return join('&nbsp;', array_fill(0, min(5, $user_score), $html));
            });

            $grid->master_cmt('师傅评论')->limit(30);
            $grid->master_score('师傅评分')->display(function ($master_score) {
                $html = "<i class='fa fa-star' style='color:#ff8913'></i>";

                return join('&nbsp;', array_fill(0, min(5, $master_score), $html));
            });

            $grid->created_at('创建时间');

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
        return Admin::form(SkbCommentModel::class, function (Form $form) {

            $form->text('order_id', '订单ID');

            $form->textarea('user_cmt', '用户评论');
            $form->slider('user_score', '用户评分')
                 ->options(['max' => 5, 'min' => 1, 'step' => 0.1, 'postfix' => '用户评分']);

            $form->divider();

            $form->textarea('master_cmt', '师傅评论')
                 ->help('暂时不开放');
            $form->slider('master_score', '师傅评分')
                 ->options(['max' => 5, 'min' => 1, 'step' => 0.1, 'postfix' => '用户评分'])
                 ->help('暂时不开放');

        });
    }
}
