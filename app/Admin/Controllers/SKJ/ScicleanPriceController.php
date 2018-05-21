<?php

namespace App\Admin\Controllers\SKJ;

use App\Models\SKJ\ScicleanPriceModel;
use App\Models\SKJ\ScicleanCatesModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ScicleanPriceController extends Controller
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

            $content->header('净水器产品价格');
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
        return Admin::grid(ScicleanPriceModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            // 产品类别
            $grid->cate_id('所属分类')->display(function ($cateId) {
                return ScicleanCatesModel::find($cateId)->cate_name;
            })->label('success');

            $grid->product_name('产品型号')->label('primary');
            $grid->product_img('产品图片')->image('', 100, 100);
            $grid->product_price('产品零售价(含安装)')->display(function ($product_price) {
                return $product_price.'元';
            })->label('info');
            $grid->install_price('建议安装价格')->display(function ($install_price) {
                return $install_price.'元';
            })->label('default');
            $grid->remarks('备注')->limit(10);
            $grid->created_at('创建时间');

            $grid->disableExport();

            $grid->filter(function ($filter) {

                $filter->disableIDFilter();

                $filter->like('product_name', '产品型号');
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
        return Admin::form(ScicleanPriceModel::class, function (Form $form) {

            $form->select('cate_id', '所属分类')
                 ->options(ScicleanCatesModel::all()
                 ->pluck('cate_name','id'));

            $form->text('product_name', '产品品名');
            $form->image('product_img', '产品图片');
            $form->currency('product_price', '产品价格')->symbol('￥');
            $form->currency('install_price', '建议安装价格')
                 ->symbol('￥')
                 ->help('价格仅供参考');
            $form->textarea('remarks', '备注');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
