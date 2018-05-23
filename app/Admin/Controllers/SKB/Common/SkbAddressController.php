<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbAddressModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbAddressController extends Controller
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

            $content->header('地址管理');
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
        return Admin::grid(SkbAddressModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->area('地址区域')->label('primary');
            $grid->addr('详细地址')->label('info');
            $grid->contacts('联系人')->prependIcon('user');
            $grid->contacts_mobile('联系人手机号')->prependIcon('phone');

            $grid->tag('标签')->display(function ($tag) {
                if ($tag === 1) {
                    return '家';
                } elseif ($tag === 2) {
                    return '公司';
                } elseif ($tag === 3) {
                    return '学校';
                } else {
                    return '其他';
                }
            })->label('primary');


            $is_default = [
                'on'  => ['value' => 1, 'text' => '默认', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $grid->is_default('默认地址')->switch($is_default);


            $grid->created_at('创建时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIDFilter();

                $filter->like('contacts', '联系人');
                $filter->like('contacts_mobile', '联系人手机号');
                $filter->like('addr', '详细地址');

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
        return Admin::form(SkbAddressModel::class, function (Form $form) {

            $form->number('uid', '用户ID');
            $form->text('area', '地址区域');
            $form->text('addr', '详细地址');
            $form->text('contacts', '联系人');
            $form->mobile('contacts_mobile', '联系人手机号')
                 ->options(['mask' => '999 9999 9999']);

            $form->radio('tag', '标签')
                 ->options([
                     '1' => '家',
                     '2' => '公司',
                     '3' => '学校',
                     '4' => '其他'
                 ])->default('1');

            $is_default = [
                'on'  => ['value' => 1, 'text' => '默认', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_default', '设为默认地址')->states($is_default)->default('1');
        });
    }
}
