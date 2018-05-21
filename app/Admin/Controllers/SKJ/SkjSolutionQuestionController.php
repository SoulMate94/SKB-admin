<?php

namespace App\Admin\Controllers\SKJ;

use App\Models\SKJ\SkjSolutionQuestionModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkjSolutionQuestionController extends Controller
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
        return Admin::grid(SkjSolutionQuestionModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->username('用户名');
            $grid->mobile('联系方式');
            $grid->address('地址');
            $grid->user_demand('用户需求')->select([
                1 => '净水解决方案',
                2 => '水路传输解决方案',
                3 => '智能卫浴解决方案',
                4 =>'软净水一体机解决方案',
                5 =>'全无水质管理解决方案'
            ]);

            $grid->created_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(SkjSolutionQuestionModel::class, function (Form $form) {
            $form->tab('用户需求',function ($form){
                $form->text('username','用户名');
                $form->text('mobile','联系方式');
                $form->text('address','地址');
                $form->select('user_demand','用户需求')->options([
                    1 => '净水解决方案',
                    2 => '水路传输解决方案',
                    3 => '智能卫浴解决方案',
                    4 =>'软净水一体机解决方案',
                    5 =>'全无水质管理解决方案'
                ]);
            })->tab('硬件条件',function ($form){
                $form->select('house_type','房屋类型')->options([1 => '套房', 2 => '别墅', 3 => '民房']);
                $form->select('water_pipe','原有水管材质')->options([
                    1 => '不锈钢',
                    2 => '塑料',
                    3 => '镀锌',
                    4 =>'其它']);

                $outlet = [
                    'on'  => ['value' => 1, 'text' => '有插座', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无插座', 'color' => 'danger'],
                ];
                $elevator = [
                    'on'  => ['value' => 1, 'text' => '有电梯', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无电梯', 'color' => 'danger'],
                ];
                $picture = [
                    'on'  => ['value' => 1, 'text' => '有拍照', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无拍照', 'color' => 'danger'],
                ];
                $reservation = [
                    'on'  => ['value' => 1, 'text' => '有接口', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无接口', 'color' => 'danger'],
                ];

                $form->switch('is_power_outlet','电源插座')
                    ->states($outlet)
                    ->default(true);
                $form->number('install_floor','安装楼层')->max(1000);
                $form->switch('elevator','是否有电梯')
                    ->states($elevator)
                    ->default(true);
                $form->number('elevator_width','电梯宽度');
                $form->switch('is_take_picture','是否有进行安装位置拍照')
                    ->states($picture)
                    ->default(true);
                $form->switch('wash_basin_reservation','洗手盆预留接口')
                    ->states($reservation)
                    ->default(true);
                $form->select('wash_basin_material','洗手盆材质')->options([
                    1 => '不锈钢',
                    2 => '石料',
                    3 =>'其它']);
            })->tab('水质监测',function ($form){
                $form->number('water_pressure_flowmeter','水压流量计')
                    ->help('单位:Mpa');
                $form->number('TDS_test_pen','TDS测试笔')
                    ->help('单位:PPM');
                $form->number('PHP_test_pen','PH测试笔')
                    ->help(' ');
            })->tab('管道预装',function ($form){
                $form->select('cohesive_unit','衔接单位')->options([
                    1=>'业主',
                    2=>'装修公司'
                ]);
                $form->select('water_inlet_pipe_size','入水口管径')->options([
                    1=>'4分',
                    2=>'6分',
                    3=>'1寸'
                ]);
                $form->select('water_inlet_material','入水口管材质')->options([
                    1=>'不锈钢',
                    2=>'PPR',
                    3=>'镀锌管'
                ]);

                $is_floor_warm = [
                    'on'  => ['value' => 1, 'text' => '有地暖', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无地暖', 'color' => 'danger'],
                ];
                $is_drawing = [
                    'on'  => ['value' => 1, 'text' => '有', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无', 'color' => 'danger'],
                ];

                $form->switch('is_floor_warm','地暖')
                    ->states($is_floor_warm)
                    ->default(true);
                $form->switch('is_drawing','施工图纸')
                    ->states($is_drawing)
                    ->default(true);
                $form->select('heater','热水器')->options([
                    1=>'空气能',
                    2=>'太阳能',
                    3=>'天然气'
                ]);
                $form->switch('is_backwater','是否加回水')
                    ->states($is_drawing)
                    ->default(false);
                $form->textarea('house_measurement','户型测量')
                    ->placeholder('无图纸必填')
                    ->rows(15)
                    ->help('无图纸必填,有图纸选填');
            })->tab('一体机',function ($form){
                $outlet = [
                    'on'  => ['value' => 1, 'text' => '有', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '无', 'color' => 'danger'],
                ];

                $form->number('monthly_water','日均水量')->help('单位:加仑');
                $form->number('use_water_people','用水人数')->help('单位:人');
                $form->number('building_height','建筑层高')->help('单位:层');
                $form->text('is_install_position','安装位置')
                    ->help('安装位置,如果为空,表示平台用户,我们已经有数据了,可以不填');
                $form->switch('is_power_supply','电源')
                    ->states($outlet)
                    ->default(true);
                $form->number('bathtub','浴缸')
                ->help('如果为0,表示没有')->default(0);
                $form->divide();
                $form->html('','环境尺寸');
                $form->number('long','长')->help('单位:cm');
                $form->number('width','宽')->help('单位:cm');
                $form->number('height','高')->help('单位:cm');
                $form->divide();
                $form->switch('is_network','网络')->states($outlet)->default(true);
                $form->select('shower','沐浴器')->options([
                    1=>'预埋式',
                    2=>'普通'
                ]);
            })->tab('其他信息备注',function ($form){
                $form->textarea('remark','其他信息备注')->help('卫浴/全屋');
                $form->select('service_score','服务满意度')->options([
                    1=>'非常好',
                    2=>'好',
                    3=>'一般',
                    4=>'不好'
                ]);
            });
        });
    }
}
