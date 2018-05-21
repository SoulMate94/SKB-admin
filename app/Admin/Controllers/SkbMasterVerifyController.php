<?php
/**
 * Created by PhpStorm.
 * User: j5521
 * Date: 2018/5/21
 * Time: 下午 04:23
 */

namespace App\Admin\Controllers;

use App\Models\SkbFilterLevelModel;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SkbMasterVerifyController extends Controller
{
    public function index(Content $content)
    {
        $content->header('师傅认证');
        $content->description('description');

        $content->body($this->grid());
    }
}