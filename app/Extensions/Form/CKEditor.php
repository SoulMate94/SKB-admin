<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    protected $view = 'admin.ckeditor';

    public static $js = [
        '/vendor/ckeditor/ckeditor.js',
        '/vendor/ckeditor/adapters/jquery.js',
    ];

    public function render()
    {
        $this->script = "$('textarea.{$this->getElementClass()[0]}').ckeditor();";

        return parent::render();
    }
}