<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\SkbMasterVerifyModel,
    App\Models\SKB\Master\SkbOpenAreaModel,
    App\Models\SKB\Master\SkbServiceCateModel,
    App\Models\China\SkbAreaModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbMasterVerifyController  extends Controller
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

            $content->header('header');
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

            $content->header('header');
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

            $content->header('header');
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
        return Admin::grid(SkbMasterVerifyModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->mid('用户id');
            $grid->id_number('身份证号码');
            $grid->work_year('工作年限');
            $grid->verify_status('认证状态');
            $grid->is_del('是否可用');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbMasterVerifyModel::class, function (Form $form) {

            $form->display('skb_user.username', '用户姓名');
            $form->display('skb_user.nickname', '微信昵称');
            $form->display('skb_user.mobile', '手机号码');
            $form->display('id_number','身份证号码');
            $form->display('work_year','工作年限')->help('单位:年');
            $form->embeds('work_area', '工作区域', function ($form) {

                $form->display(0, '区域1')->with( function ($dat) {
                    if (!$dat) return false;

                    $res        = SkbOpenAreaModel::where('id', $dat)->first();
                    $province   = SkbAreaModel::select('name')->where('id', $res['province'])->first();
                    $city       = SkbAreaModel::select('name')->where('id', $res['city'])->first();
                    $district   = SkbAreaModel::select('name')->where('id', $res['district'])->first();
                    return $province['name'].'--'.$city['name'].'--'.$district['name'];
                });

                $form->display(1, '区域2')->with( function ($dat) {
                    if (!$dat) return false;

                    $res        = SkbOpenAreaModel::where('id', $dat)->first();
                    $province   = SkbAreaModel::select('name')->where('id', $res['province'])->first();
                    $city       = SkbAreaModel::select('name')->where('id', $res['city'])->first();
                    $district   = SkbAreaModel::select('name')->where('id', $res['district'])->first();
                    return $province['name'].'--'.$city['name'].'--'.$district['name'];
                });

                $form->display(2, '区域3')->with( function ($dat) {
                    if (!$dat) return false;

                    $res        = SkbOpenAreaModel::where('id', $dat)->first();
                    $province   = SkbAreaModel::select('name')->where('id', $res['province'])->first();
                    $city       = SkbAreaModel::select('name')->where('id', $res['city'])->first();
                    $district   = SkbAreaModel::select('name')->where('id', $res['district'])->first();
                    return $province['name'].'--'.$city['name'].'--'.$district['name'];
                });
            });

            $form->multipleImage('id_card_img', '身份证照片')->move('/masterVerify/'.date('Ymd'))->uniqueName()->removable();

            $form->embeds('product_type_id', '产品类别', function ($form) {

                $form->display(0, '类别1')->with( function ($dat) {
                    $res        = SkbOpenAreaModel::where('id', $dat)->first();
                    $province   = SkbAreaModel::select('name')->where('id', $res['province'])->first();
                    $city       = SkbAreaModel::select('name')->where('id', $res['city'])->first();
                    $district   = SkbAreaModel::select('name')->where('id', $res['district'])->first();
                    return $province['name'].'--'.$city['name'].'--'.$district['name'];
                });
            });

            $form->display('service_type_id', '服务类别')->with(function ($data) {
                if(!$data){
                    return '没有服务';
                }
                $res = '';
                foreach (json_decode($data) as $v){
                    $res .= SkbServiceCateModel::where('id', $v)->first()['title'].'--';
                }
                return rtrim($res, '--');
            });

            $form->timeRange('service_sta_time','service_end_time','服务时间');
            $form->select('verify_status','认证状态')->options([
                '0' =>  '未提交认证',
                '1' =>  '未审核',
                '2' =>  '审核成功',
                '-1' =>  '审核失败',
            ]);
            $form->textarea('failure_reason','认证失败原因')->help('认证失败必填!!!');


        });
    }
}
