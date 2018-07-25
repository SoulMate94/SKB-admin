<?php

namespace App\Admin\Controllers\SKB\User;

use App\Models\SKB\User\SkbFeedbackUserModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbFeedbackUserController extends Controller
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

            $content->header('意见反馈V3');
            $content->description('针对用户端设计');

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
        return Admin::grid(SkbFeedbackUserModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // $grid->uid('用户ID');
            $grid->feedback_cate('反馈类别')->display( function ($feedback_cate) {
                    return $feedback_cate == 1
                        ? '<span class="label label-success">产品</span>'
                        : '<span class="label label-primary">服务</span>';
            });
            $grid->feedback_type('反馈类型')->display( function ($feedback_type) {
                switch ($feedback_type) {
                    case 1:
                        return '<span class="label label-primary">咨询</span>';
                    case 2:
                        return '<span class="label label-danger">建议</span>';
                    case 3:
                        return '<span class="label label-info">其他</span>';
                }
            });
            $grid->feedback_content('反馈内容')->limit('20', '...');
            $grid->feedback_img('反馈图片')->image('', 100, 100);

            $grid->contacts('联系人姓名')->prependIcon('user');
            $grid->contacts_info('联系方式')->prependIcon('mobile');
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
        return Admin::form(SkbFeedbackUserModel::class, function (Form $form) {

            $form->display('id', 'ID');
        });
    }
}
