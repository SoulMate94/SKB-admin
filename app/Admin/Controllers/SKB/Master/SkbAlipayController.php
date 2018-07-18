<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\SkbAlipayModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbAlipayController extends Controller
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

            $content->header('支付宝账号');
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
        return Admin::grid(SkbAlipayModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->master_id('师傅ID')->label('success');
            $grid->real_name('真实姓名')->label('info');
            $grid->alipay_account('支付宝账号');
            $is_verify = [
                            'on'  => ['value' => 1, 'text' => '通过', 'color' => 'primary'],
                            'off' => ['value' => 0, 'text' => '拒绝', 'color' => 'default'],
                        ];
            $grid->is_verify('是否认证')->switch($is_verify);

            $grid->filter(function ($filter) {
                $filter->disableIDFilter();
                $filter->like('real_name', '真实姓名');
            });

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
        return Admin::form(SkbAlipayModel::class, function (Form $form) {

            $form->number('master_id', '师傅ID');
            $form->text('real_name', '真实姓名');
            $form->text('alipay_account', '支付宝账号');

            $is_verify = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '拒绝', 'color' => 'default'],
            ];
            $form->switch('is_verify', '是否通过审核')->states($is_verify);
        });
    }
}
