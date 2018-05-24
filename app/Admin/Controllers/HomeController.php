<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index_old()
    {
        return Admin::content(function (Content $content) {

            $content->header('SCICLEAN管理后台');
            $content->description('广州美管饮水工程有限公司');

            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('SCICLEAN管理后台');
            $content->description('广州美管饮水工程有限公司');

            $content->row(function ($row) {

                $params = $this->count();

                $row->column(3, new InfoBox(
                    '用户管理', 'users', 'aqua', '/admin/skb_users', $params['user_count']
                ));
                $row->column(3, new InfoBox(
                    '订单管理', 'shopping-cart', 'green', 'admin/skb_order', '150'
                ));
                $row->column(3, new InfoBox(
                    '师傅管理', 'user-secret', 'yellow', '/admin/skb_master_verify', $params['master_count']
                ));
                $row->column(3, new InfoBox(
                    '文章管理', 'book', 'red', '/admin/skb_article_list', $params['article_count']
                ));
            });

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }

    public function count()
    {
        $params['user_count']    = DB::table('skb_users')->count();
        //$params['order_count']   = DB::table('skb_orders')->count();
        $params['master_count']  = DB::table('skb_master_verify')->count();
        $params['article_count'] = DB::table('skb_article')->count();

        return $params;
    }
}
