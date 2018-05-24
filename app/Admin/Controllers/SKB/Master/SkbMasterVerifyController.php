<?php

namespace App\Admin\Controllers\SKB\Master;

use App\Models\SKB\Master\{
        SkbMasterVerifyModel,
        SkbOpenAreaModel,
        SkbServiceCateModel};
use App\Models\{
        SKB\Common\SkbProductCateModel as ProductCate,
        China\SkbAreaModel};

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\MessageBag;

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

            $content->header('师傅认证');
            $content->description('师傅认证列表');

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

            $content->header('师傅认证');
            $content->description('师傅认证详情');

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

            $content->header('师傅认证');
            $content->description('提交师傅认证');

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
            $grid->column('skb_user.username', '用户姓名')->label('success');
            $grid->column('skb_user.nickname', '微信昵称')
                 ->prependIcon('wechat');
            $grid->id_number('身份证号码')->label('warning');
            $grid->work_year('工作年限')->display(function ($year) {
                return $year.'&nbsp;年';
            })->label('primary');
            $grid->verify_status('认证状态')->display(function ($status) {
                switch ($status) {
                    case -1:
                        return '<span class="label label-danger">认证失败</span>';
                    case 1 :
                        return '<span class="label label-info">审核中...</span>';
                    case 2 :
                        return '<span class="label label-success">认证成功</span>';
                    default :
                        return '<span class="label label-primaey">未提交认证</span>';
                }
            });
            $is_del = [
                'on'   => ['value' => 1, 'text' => '禁用', 'color' => 'danger'],
                'off'  => ['value' => 0, 'text' => '可用', 'color' => 'success'],
            ];
            $grid->is_del('是否可用')->switch($is_del);
            $grid->updated_at('修改时间');

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });

            $grid->disableCreateButton();
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

            $form->multipleImage('id_card_img', '身份证照片')
                ->move('/masterVerify/'.date('Ymd'))
                ->uniqueName()
                ->removable()// 多图删除
                ->help('这几张图片不可更改');

            $form ->display('product_type_id', '产品类别')
                  ->with(function ($dat) {
                            $res = '';
                            foreach ($dat as $v) {
                                $res .= ProductCate::select('title')
                                        ->where([
                                            ['id', $v],
                                            ['is_active', 1]
                                        ])
                                        ->first()['title'].'--';
                            }
                            return rtrim($res, '--');
                        });

            $form->display('service_type_id', '服务类别')
                ->with(function ($data) {
                            if(!$data){
                                return '没有服务';
                            }
                            $res = '';
                            foreach ($data as $v){
                                $res .= SkbServiceCateModel::select('title')
                                        ->where([
                                            ['id', $v],
                                            ['is_active', 1]
                                            ])
                                        ->first()['title'].'--';
                            }
                            return rtrim($res, '--');
                        });

            $form->timeRange('service_sta_time','service_end_time','服务时间');

            $form->select('verify_status','认证状态')
                 ->options([
//                '0' =>  '未提交认证',
                '1' =>  '审核中',
                '2' =>  '审核成功',
                '-1'=>  '审核失败',
            ])
                 ->attribute('id', 'verify_status');

            $is_del = [
                'on'   => ['value' => 1, 'text' => '禁用', 'color' => 'danger'],
                'off'  => ['value' => 0, 'text' => '可用', 'color' => 'success'],
            ];
            $form->switch('is_del', '是否可用')->states($is_del);

            $form->textarea('failure_reason','认证失败原因')
                 ->attribute('id','failure_reason')
                 ->help('<span class="label label-danger">认证失败必填!!!</span>');
            $script = <<<script
                <script>
                    var verifyStatus = $('#verify_status');
                    var failure_reason = $('#failure_reason').parents('.form-group');
                    if(verifyStatus.val() != -1){
                        failure_reason.hide();
                    }
                    verifyStatus.change(function() {
                      if($(this).val() ==-1){
                          failure_reason.show();
                          return true;
                      }
                      failure_reason.hide();
                          return true;
                    })
                </script>
script;
            $form->html($script);

            $form->ignore('id_card_img');

            //保存前回调
            $form->saving(function (Form $form) {
                $form->service_sta_time = strtotime($form->service_sta_time);
                $form->service_end_time = strtotime($form->service_end_time);

                if($form->verify_status != -1) {
                    $form->failure_reason = '';
                    return true;
                }

                if($form->failure_reason == null) {
                    $image = <<<image
认证失败时必须要填写原因 <img style="max-width: 75px;border-radius: 15px" src="/uploads/images/MlZaK.gif" />
image;
                    $error = new MessageBag([
                        'title'   => 'Error',
                        'message' => $image
                    ]);
                    return back()->with(compact('error'));
                }
            });
        });
    }
}
