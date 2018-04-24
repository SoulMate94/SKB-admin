<?php

namespace App\Admin\Controllers;

use App\Models\SkbFilterInstallModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbFilterInstallController extends Controller
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

            $content->header('滤芯安装/更换记录');
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
        return Admin::grid(SkbFilterInstallModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->filter_id('滤芯名称');
            $grid->user_id('业主姓名');
            $grid->master_id('师傅姓名');

            $grid->instaled_at('安装时间');
            $grid->expired_at('更换时间');
            $grid->expired_time('更换倒计时')->sortable();

            // $grid->created_at();
            // $grid->updated_at();

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                $filter->like('filter_id', '滤芯名称');
                $filter->like('user_id', '业主姓名');
                $filter->like('master_id', '师傅姓名');
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
        return Admin::form(SkbFilterInstallModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
