<?php

namespace App\Admin\Controllers\SKB\System;

use App\Models\{
            SKB\System\MessageModel,
            SkbUsersModel};

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Ixudra\Curl\Facades\Curl;

class MessageController extends Controller
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
        return Admin::grid(MessageModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('标题');
            $grid->content('内容');
            $grid->recipient_id('收信人')->display(function ($recipient_id) {
                return SkbUsersModel::select('username')
                    ->where('id', $recipient_id)
                    ->first()['username'];
            })->label('primary')->prependIcon('user');
            $grid->message_type('消息类型');

            $grid->created_at('创建时间');
//            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MessageModel::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title','标题');
            $form->text('content','内容');
            $form->select('recipient_id', '收信人')
                ->options(function (){
                    $tmp = [];
                    foreach (SkbUsersModel::select(['id', 'username'])
                                             ->get()
                                             ->toArray() as $v){
                        $tmp[$v['id']] = $v['username'];
                    }
                    return $tmp;
                });
            $form->select('message_type','消息种类')
                ->options([1 => '纯文本', 2 => '跳转链接']);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                $user_id     = $form->model()->recipient_id;

                $openid      = SkbUsersModel::select('openid')
                                                ->where(['id',$user_id])
                                                ->get()
                                                ->openid;
                $template_id = 'messageNotification';
                $dat         = [
                            'Admin',
                            $form->model()->content,
                            date('y-m-d')
                        ];

                $response = Curl::to('https://skb-api.sciclean.cn/')
                                ->withData([
                                    'user_id'     => $user_id,
                                    'open_id'     => $openid,
                                    'template_id' => $template_id,
                                    'dat'         => json_encode($dat),
                                ])
                                ->post();
            });
        });
    }
}
