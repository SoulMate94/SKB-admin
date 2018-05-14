<?php

namespace App\Admin\Controllers;

use App\Models\UsersModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Collection;


class UsersController extends Controller
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

            $content->header('会员管理');
            $content->description('vip-user-manage');

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
            $content->description('edit');

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
            $content->description('new');

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
        return Admin::grid(UsersModel::class, function (Grid $grid) {


            $grid->id('ID')->sortable();

            $grid->name('姓名')->label('primary');

            $grid->email('邮箱')->prependIcon('envelope');

            $grid->column('homepage')->urlWrapper();

            $grid->disableExport(); 


            /*
            $grid->actions(function ($actions) {

                if ($actions->getKey() % 2 == 0) {
                    $actions->disableDelete();
                    $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
                } else {
                    $actions->disableEdit();
                    $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
                }
            });
            */
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(UsersModel::class, function (Form $form) {

            $form->model()->makeVisible('password');

            $form->display('id', 'ID');
            $form->text('name','姓名')
                 ->rules('required');
            $form->email('email','邮箱')
                 ->rules('required');
            $form->url('homepage');
            $form->password('password', '密码')
                 ->rules('confirmed|required')
                 ->placeholder('请输入密码');
            $form->password('password_confirmation', '确认密码')
                 ->rules('required')
                 ->placeholder('请确认密码');
            $form->display('created_at', '创建时间');

            $form->ignore(['password_confirmation']);

        });
    }
}
