<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;
use App\Admin\Extensions\Column\ExpandRow;
use App\Admin\Extensions\Column\OpenMap;
use App\Admin\Extensions\Column\FloatBar;
use App\Admin\Extensions\Column\Qrcode;
use App\Admin\Extensions\Column\UrlWrapper;
use Encore\Admin\Facades\Admin;

Encore\Admin\Form::forget(['map', 'editor']);

Admin::css('/vendor/prism/prism.css');
Admin::js('/vendor/prism/prism.js');
Admin::js('/vendor/clipboard/dist/clipboard.min.js');

Column::extend('color', function ($value, $color) {
    return "<span style='color: $color'>$value</span>";
});


Column::extend('prependIcon', function ($value, $icon) {
    return "<span style='color: #999;'><i class='fa fa-$icon'></i>  $value</span>";
});

Column::extend('expand', ExpandRow::class);
Column::extend('openMap', OpenMap::class);
Column::extend('floatBar', FloatBar::class);
Column::extend('qrcode', Qrcode::class);
Column::extend('urlWrapper', UrlWrapper::class);
Column::extend('action', Grid\Displayers\Actions::class);