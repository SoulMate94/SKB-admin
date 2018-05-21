<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\SkbBankCardModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Zhuzhichao\BankCardInfo\BankCard;
use Illuminate\Support\MessageBag;

class SkbBankCardController extends Controller
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

            $content->header('银行卡管理');
            $content->description('');

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

            $content->header('编辑银行卡');
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

            $content->header('新增银行卡');
            $content->description('create');

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
        return Admin::grid(SkbBankCardModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->real_name('真实姓名');
            $grid->ID_number('身份证号码');
            $grid->bank_reserve_mobile('银行预留手机号码');
            $grid->bank_card_number('银行卡号');
            $grid->bank_name('开户银行');
            $grid->bank_branch_name('开户银行支行');

            $grid->card_type_name('银行卡类型')->display(function ($card_type_name) {
                return $card_type_name == 1
                       ? '储蓄卡'
                       : '信用卡';
            });

            $is_verify = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '拒绝', 'color' => 'default'],
            ];
            $grid->is_verify('是否通过审核')->switch($is_verify);

            $grid->disableExport();

            $grid->filter(function ($filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                $filter->like('real_name', '真实姓名');
                $filter->like('bank_reserve_mobile', '银行预留手机号码');
            });

            $grid->created_at('添加时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbBankCardModel::class, function (Form $form) {

            $form->text('real_name', '真实姓名')
                 ->rules('required');
            $form->text('ID_number', '身份证号码')
                 ->rules('required');
            $form->mobile('bank_reserve_mobile', '银行预留手机号码')
                 ->options(['mask' => '999 9999 9999'])
                 ->rules('required');
            $form->text('bank_card_number', '银行卡号')
                ->rules('required');
            $form->text('bank_name', '开户银行');
            $form->text('bank_branch_name', '开户银行支行');
            $form->select('card_type_name', '银行卡类型')
                 ->options([1 => '储蓄卡', 2 => '信用卡']);

            $is_verify = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '拒绝', 'color' => 'default'],
            ];
            $form->switch('is_verify', '是否通过审核')->states($is_verify);

            $form->saving(function (Form $form) {

                $bank = BankCard::info($form->bank_card_number);

                if (!$bank['validated']) {

                    $error = new MessageBag([
                        'title'   => '未知的银行卡号',
                        'message' => '请重新填写正确的银行卡',
                    ]);

                    return back()->with(compact('error'));
                }

            });
        });
    }
}
