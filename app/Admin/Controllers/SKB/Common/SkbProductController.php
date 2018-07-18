<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Common\SkbProductCateModel;
use App\Models\SKB\Common\SkbProductModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbProductController extends Controller
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

            $content->header('产品管理');
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
        return Admin::grid(SkbProductModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->product_name('产品名称')->label('primary');
            $grid->product_cate_id('所属类别')->display(function ($product_cate_id) {
                return SkbProductCateModel::find($product_cate_id)->title;
            })->label('info');
            $grid->product_img('产品图片')->image('', 100, 100);
            $grid->install_price('建议安装价格')->display(function ($install_price) {
                return $install_price.'元';
            })->prependIcon('rmb');
            $grid->uninstall_price('建议拆装价格')->display(function ($uninstall_price) {
                return $uninstall_price.'元';
            })->prependIcon('rmb');

            $grid->product_exp('产品说明')->display(function ($product_exp) {
                return $product_price ?? '暂无说明';
            })->limit(20);

            $grid->created_at('添加时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {
                $filter->disableIDFilter();
                $filter->like('product_name', '产品名称');
                $filter->like('skb_product_cate.title', '所属类别');
                $filter->lile('product_exp', '产品说明');
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
        return Admin::form(SkbProductModel::class, function (Form $form) {

            $form->select('product_cate_id', '所属产品类别')
                 ->options(SkbProductCateModel::where('is_active', 1)
                 ->pluck('title', 'id'));

            $form->text('product_name', '产品名称');
            $form->currency('install_price', '建议安装价格')->symbol('￥');
            $form->currency('uninstall_price', '建议拆装价格')->symbol('￥');
            $form->image('product_img', '产品图片');
            $form->textarea('product_exp', '产品说明');
            $is_active = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_active', '是否可用')->states($is_active)->default(1);

        });
    }
}
