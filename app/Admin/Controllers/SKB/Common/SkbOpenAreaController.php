<?php

namespace App\Admin\Controllers\SKB\Common;

use App\Models\SKB\Master\SkbOpenAreaModel;
use App\Models\China\SkbAreaModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkbOpenAreaController extends Controller
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

            $content->header('区域开放设置');
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
        return Admin::grid(SkbOpenAreaModel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->province('省')->display(function ($province) {
                return SkbAreaModel::find($province)->name;
            })->label('success');

            $grid->city('市')->display(function ($city) {
                return SkbAreaModel::find($city)->name;
            })->label('primary');

            $grid->district('区')->display(function ($district) {
                return SkbAreaModel::find($district)->name;
            })->label('info');

            $is_open = [
                'on'  => ['value' => 1, 'text' => '开放', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];
            $grid->is_open('是否开放')->switch($is_open);

            $grid->created_at('添加时间');

            $grid->disableExport();

            $grid->filter(function (Grid\Filter $filter) {

                $filter->disableIdFilter();

                $filter->equal('province', '省')
                       ->select(SkbAreaModel::province()->pluck('name', 'id'))
                       ->load('city', '/admin/skb/area/city');

                $filter->equal('city', '市')->select()
                       ->load('district', '/admin/skb/area/district');

                $filter->equal('district', '区')->select();

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
        return Admin::form(SkbOpenAreaModel::class, function (Form $form) {

            $form->select('province', '省')
                 ->options(SkbAreaModel::province()->pluck('name', 'id'))
                 ->load('city', '/admin/skb/area/city');

            $form->select('city', '市')->options(function ($id) {

                return SkbAreaModel::options($id);

            })->load('district', '/admin/skb/area/district');

            $form->select('district', '区')->options(function ($id) {

                return SkbAreaModel::options($id);

            });

            // $form->text('street', '街道');

            $is_open = [
                'on'  => ['value' => 1, 'text' => '开放', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'default'],
            ];

            $form->switch('is_open', '是否开放')->states($is_open)->default('1');

        });
    }

    public function city(Request $request)
    {
        $provinceId = $request->get('q');

        return SkbAreaModel::city()->where('parent_id', $provinceId)->get(['id', DB::raw('name as text')]);
    }

    public function district(Request $request)
    {
        $cityId = $request->get('q');

        return SkbAreaModel::district()->where('parent_id', $cityId)->get(['id', DB::raw('name as text')]);
    }

    public function form_test()
    {
        // 仅供参考 by caoxl
        return Admin::form(SkbOpenAreaModel::class, function (Form $form) {
            $model = $form->model();
            $province = $model->province_id ?: -1;
            $city     = $model->city_id ?: -2;
            $county   = $model->city_id ?: -3;
            $town     = $model->town_id ?: -4;

            $provinces = SkbAreaModel::whereIdOrParentId(
                $province, 0
            )->pluck('name as text', 'id');

            $cities = SkbAreaModel::whereIdOrParentId(
                $city, $province
            )->pluck('name as text', 'id');

            $counties = SkbAreaModel::whereIdOrParentId(
                $county, $city
            )->plcuk('name as text', 'id');

            $towns = SkbAreaModel::whereIdOrParentId(
                $town, $county
            )->pluck('name as text', 'id');

            if ($form->model()->id) {
                $form->select('province_id', '所在省')->options($provinces);
                $form->select('city_id', '所在市')->options($cities);
                $form->select('county_id', '所在区县')->options($counties);
                $form->select('town_id', '所在镇/街道')->options($towns);
            } else {
                $form->select('province_id', '选择省')
                     ->options($provinces)
                     ->load('city_id', 'api/arealist');

                $form->select('city_id', '选择市')
                     ->options($cities)
                     ->load('county_id', 'api/arealist');

                $form->select('county_id', '选择省')
                    ->options($counties)
                    ->load('town_id', 'api/arealist');

                $form->select('town_id', '选择省')
                    ->options($towns);
            }
        });
    }
}
