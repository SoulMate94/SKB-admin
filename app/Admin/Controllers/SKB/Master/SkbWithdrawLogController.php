<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\{
    SkbBankCardModel,
    SkbAlipayModel,
    SkbWithdrawLogModel
};

use App\Models\SkbUsersModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbWithdrawLogController extends Controller
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

            $content->header('提现申请');
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
        return Admin::grid(SkbWithdrawLogModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->mid('师傅ID')->display(function ($mid) {
                return SkbUsersModel::find($mid)->username;
            })->prependIcon('user-secret');

            $grid->mobile('提现账号手机号')->prependIcon('phone');

            $grid->payee_type('提现账号类型')->display(function ($payee_type) {
                return $payee_type == 1 ? '银行卡' : '支付宝';
            })->prependIcon('bank');

            $grid->waid('提现账号')->display(function ($waid) {

                if (1 == $this->payee_type) {
                    return SkbBankCardModel::find($waid)->bank_card_number;
                }

                return SkbAlipayModel::find($waid)->alipay_account;

            })->prependIcon('credit-card');

            $grid->amount('提现金额')->prependIcon('yen');

            $status = [
                'on'  => ['value' => 2, 'text' => '提现成功', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => '处理中...', 'color' => 'default'],
            ];
            $grid->status('提现状态')->switch($status);

            $grid->notes('备注')->label('info');

            $grid->created_at('申请时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIDFilter();

                $filter->like('mobile', '提现手机号');
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
        return Admin::form(SkbWithdrawLogModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
