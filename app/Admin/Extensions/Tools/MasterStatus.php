<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class MasterStatus extends AbstractTool
{
    public function script()
    {
        $url = Request::fullUrlWithQuery(['status' => '_status_']);

        return <<<EOT

$('input:radio.master-status').change(function () {

    var url = "$url".replace('_status_', $(this).val());

    $.pjax({container:'#pjax-container', url: url });

});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'all'   => '全部',
            'jsl'   => '净水类',
            'sgl'   => '管道类',
        ];

        return view('tools.status', compact('options'));
    }
}
