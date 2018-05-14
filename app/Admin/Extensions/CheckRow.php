<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;

class CheckRow
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-check-row').on('click', function () {

    // Your code.
        location.href=window.location.href+'/'+$(this).data('id')+'/show';

});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return "<a class='btn grid-check-row' data-id='{$this->id}'>查看详情</a>";
    }

    public function __toString()
    {
        return $this->render();
    }
}