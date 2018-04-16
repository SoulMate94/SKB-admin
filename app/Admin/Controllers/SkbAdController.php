<?php

namespace App\Admin\Controllers;

use App\Models\SkbAdModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbAdController extends Controller
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

            $content->header('水可邦广告管理');
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
        return Admin::grid(SkbAdModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->title('广告标题')->editable();
            $grid->image('缩略图')->image('', 100, 100);
            $grid->url('跳转链接')->urlWrapper();
            $grid->ad_position('广告位')->display(function ($ad_position) {
                return $ad_position == 1
                    ? 'APP首页轮播'
                    : '微信首页轮播';
            })->label('primary');
            $grid->ad_explain('广告说明')->display(function ($ad_explain) {
                return $ad_explain ?: '暂无说明';
            })->limit(30)->label('default');

            $grid->order('排序')->sortable()->editable();

            $grid->created_at('创建时间');
            // $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkbAdModel::class, function (Form $form) {

            // $form->display('id', 'ID');
            $form->text('title', '广告标题');
            $form->image('image', '图片上传');
            // $form->image('thumb', '缩略图上传');
            $form->url('url', '跳转链接');

            $AdPosition = [
                1  => 'APP首页轮播',
                2  => '微信首页轮播',
            ];
            $form->select('ad_position', '广告位')->options($AdPosition);

            $form->number('order', '排序')->default('99');

            $form->textarea('ad_explain', '广告说明');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
