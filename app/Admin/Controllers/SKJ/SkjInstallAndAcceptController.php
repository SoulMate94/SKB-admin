<?php

namespace App\Admin\Controllers\SKJ;

use App\Models\SKJ\SkjInstallAndAcceptModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkjInstallAndAcceptController extends Controller
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
        return Admin::grid(SkjInstallAndAcceptModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkjInstallAndAcceptModel::class, function (Form $form) {

            $outlet = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];

            $form->datetime('install_date','施工日期');
            $form->number('install_people','施工人数')
                ->help('单位:人');
            $form->number('install_time_consuming','安装耗时')
                ->help('单位:小时');
            $form->text('product_list','产品清点');
            $form->switch('is_accord_map','按图施工')->states($outlet);
            $form->text('change_section','更改部分')
                ->placeholder('更改部分')
                ->help('按图施工为“是”则可以为空');
            $form->select('installed_result','安装结果')->options([
                1=>'正常使用',
                2=>'出现异常',
                3=>'其它'
            ]);
            $form->text('abnormal_desction','异常描述')
                ->placeholder('异常描述')
                ->help('此处可以为空');
            $form->radio('is_repair','是否修复')
                ->options([
                    1=>'是',
                    2=>'否',
                    0=>'取消'
                ]);
            $form->text('is_use_train','使用培训');
            $form->switch('is_take_picture','拍摄安装图(备份存档)')
                ->states($outlet)
                ->default(true);

            $form->divide();
            $form->html('','水质监测');
            $form->number('raw_water_TDS','原水TDS')
                ->help('单位:MG/L');
            $form->number('raw_water_PH','原水PH');
            $form->number('raw_water_pressure','原水水压');
            $form->number('pure_water_TDS','纯水TDS')
                ->help('单位:MG/L');
            $form->number('pure_water_PH','原水水压');
            $form->number('pure_water_flow','纯水净流量');
        });
    }
}
