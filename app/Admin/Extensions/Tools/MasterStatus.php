<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;
use App\Models\SKB\Common\SkbProductCateModel as ProductCate;

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

        $options = [' ' => '全部'];
        $cate    = ProductCate::select(['id', 'title'])->where('is_active', 1)->get()->toArray();

        foreach ($cate as $value) {
            $options[$value['id']] = $value['title'];
        }

        return view('tools.status', compact('options'));
    }
}
