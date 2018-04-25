<?php

namespace App\Admin\Controllers;

use App\Models\SkbFilterInstallModel;
use App\Models\SkbFilterModel;

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

            $grid->filter_name('滤芯名称');
            $grid->user_name('业主姓名');
            $grid->master_name('师傅姓名');

            $grid->installed_at('安装时间');
            $grid->expired_at('更换时间');

            $grid->expired_time('更换倒计时')->display(function ($expired_time) {
                return $expired_time.'个月';
            })->sortable();


            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIdFilter();

                $filter->like('filter_name', '滤芯名称');
                $filter->like('user_name', '业主姓名');
                $filter->like('master_name', '师傅姓名');
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

            $form->text('filter_name', '滤芯名称');
            $form->text('user_name', '业主姓名');
            $form->text('master_name', '师傅姓名');

            $form->datetime('installed_at', '安装时间');
            $form->datetime('expired_at', '更换时间');

            $form->number('expired_time', '滤芯寿命');


        });
    }
}
