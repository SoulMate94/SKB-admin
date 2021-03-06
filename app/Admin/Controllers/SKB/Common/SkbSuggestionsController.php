<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbSuggestionsModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbSuggestionsController extends Controller
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

            $content->header('意见反馈');
            $content->description('常规设计');

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
        return Admin::grid(SkbSuggestionsModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->feedback_name('反馈人姓名');
            $grid->feedback_mobile('反馈人手机号码');
            $grid->feedback_content('反馈人内容');
            $grid->feedback_img('反馈人图片')->image('', 100, 100);
            //$grid->reply_name('回复人姓名');
            //$grid->reply_content('回复内容');
            $grid->created_at('创建时间');

            $grid->disableExport();
            $grid->disableCreateButton();

            $grid->filter(function($filter){
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('feedback_name', '反馈人姓名');
                $filter->like('feedback_mobile', '反馈人手机号码');
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
        return Admin::form(SkbSuggestionsModel::class, function (Form $form) {

            $form->display('feedback_name', '反馈人姓名');
            $form->display('feedback_mobile', '反馈人手机号码');
            $form->display('feedback_content', '反馈人内容');
            $form->image('feedback_img', '反馈图片');
            $form->text('reply_name', '回复人姓名');
            $form->textarea('reply_content', '回复内容');
            $form->datetime('updated_at', '回复时间');
        });
    }
}
