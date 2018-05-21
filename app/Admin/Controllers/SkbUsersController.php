<?php

namespace App\Admin\Controllers;

use App\Models\SkbUsersModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbUsersController extends Controller
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

            $content->header('用户管理');
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
        return Admin::grid(SkbUsersModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->username('用户名');
            $grid->openid('微信ID');
            $grid->nickname('微信昵称');
            $grid->avatar('微信头像')->image('', 132, 132);
            $grid->mobile('手机号码');
            $grid->role('角色')->display(function ($role) {
                if ($role === 1) {
                    return '用户';
                } elseif ($role === 2) {
                    return '师傅';
                } else {
                    return '用户&师傅';
                }
            });

            $grid->created_at('创建时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIDFilter();
                $filter->like('username', '用户名');
                $filter->like('nickname', '微信昵称');
                $filter->like('mobile', '手机号');

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
        return Admin::form(SkbUsersModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('uid', 'ID');
            $form->text('username', '用户名');
            $form->text('nickname', '微信昵称');
            $form->image('avatar', '微信头像');
            $form->radio('role', '角色')
                 ->options([
                     '1' => '用户',
                     '2' => '师傅',
                     '3' => '用户&师傅'
                 ])->default('1');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
