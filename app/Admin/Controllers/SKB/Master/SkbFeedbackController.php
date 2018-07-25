<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\SkbFeedbackModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbFeedbackController extends Controller
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

            $content->header('意见反馈V2');
            $content->description('针对师傅端设计');

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
        return Admin::grid(SkbFeedbackModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            // $grid->uid('用户ID');
            $grid->feedback_content('反馈内容');
            $grid->feedback_img('反馈图片')->image('', 100, 100);
            $grid->created_at('添加时间');

            $grid->filter(function($filter) {
                $filter->disableIDFilter();
                $filter->like('feedback_content', '反馈内容');
            });

            $grid->disableExport();
            $grid->disableCreateButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbFeedbackModel::class, function (Form $form) {

            $form->display('id', 'ID');
        });
    }
}
