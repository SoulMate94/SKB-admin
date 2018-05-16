<?php

namespace App\Extensions;

use Encore\Admin\Admin;

class ClickRow
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-click-row').on('click', function () {

    // Your code.
        location.href=window.location.href+'/'+$(this).data('id')+'/show';

});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());

        return '';
    }

    public function __toString()
    {
        return $this->render();
    }
}