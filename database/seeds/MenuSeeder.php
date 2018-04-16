<?php

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 水可净--start
        $SKJ = Menu::firstOrCreate([
            'uri' => 'skj'
        ], [
            'parent_id' => 0,
            'order' => 13,
            'title' => '水可净',
            'icon' => 'fa-coffee',
            'uri' => 'skj'
        ]);

        Menu::firstOrCreate([
            'uri' => 'sciclean-orders'
        ], [
            'parent_id' => $SKJ->id, // 父级菜单ID
            'order' => 14, // 排序 升序
            'title' => '净水器订单管理', // 菜单名
            'icon' => 'fa-shopping-bag', // 图标，https://fontawesome.com/icons
            'uri' => 'sciclean-orders' // URI
        ]);

        // 净水器产品价格
        Menu::firstOrCreate([
            'uri' => 'skj-price'
        ], [
            'parent_id' => $SKJ->id, // 父级菜单ID
            'order' => 15, // 排序 升序
            'title' => '净水器产品价格', // 菜单名
            'icon' => 'fa-money', // 图标，https://fontawesome.com/icons
            'uri' => 'skj-price' // URI
        ]);

        // 净水器产品分类
        Menu::firstOrCreate([
            'uri' => 'skj-cate'
        ], [
            'parent_id' => $SKJ->id, // 父级菜单ID
            'order' => 16, // 排序 升序
            'title' => '净水器产品类别', // 菜单名
            'icon' => 'fa-align-right', // 图标，https://fontawesome.com/icons
            'uri' => 'skj-cate' // URI
        ]);
        // 水可净--end

        // 水可邦--start
        $SKB = Menu::firstOrCreate([
            'uri' => ''
        ], [
            'parent_id' => 0,
            'order' => 17,
            'title' => '水可邦',
            'icon' => 'fa-bold',
            'uri' => ''
        ]);

        // 水可邦-文章管理
        $SKB_article = Menu::firstOrCreate([
            'uri' => 'skb-article'
        ], [
            'parent_id' => $SKB->id,
            'order' => 19,
            'title' => '文章管理',
            'icon' => 'fa-newspaper-o',
            'uri' => 'skb-article'
        ]);

        // 水可邦-文章管理-文章列表
        Menu::firstOrCreate([
            'uri' => 'skb_article_list'
        ], [
            'parent_id' => $SKB_article->id,
            'order' => 19,
            'title' => '文章列表',
            'icon' => 'fa-navicon',
            'uri' => 'skb_article_list'
        ]);

        // 水可邦-文章管理-文章分类
        Menu::firstOrCreate([
            'uri' => 'skb_article_cate'
        ], [
            'parent_id' => $SKB_article->id,
            'order' => 19,
            'title' => '文章分类',
            'icon' => 'fa-align-left',
            'uri' => 'skb_article_cate'
        ]);

        // 水可邦-广告管理
        $SKB_ad = Menu::firstOrCreate([
            'uri' => 'skb_ad'
        ], [
            'parent_id' => $SKB->id,
            'order' => 20,
            'title' => '广告管理',
            'icon' => 'fa-image',
            'uri' => 'skb_ad'
        ]);

        // 水可邦-银行卡管理
        Menu::firstOrCreate([
            'uri' => 'skb_bank_card'
        ], [
            'parent_id' => $SKB->id,
            'order' => 21,
            'title' => '银行卡管理',
            'icon' => 'fa-credit-card-alt',
            'uri' => 'skb_bank_card'
        ]);

        // 水可邦-银行卡管理
        Menu::firstOrCreate([
            'uri' => 'skb_present_record'
        ], [
            'parent_id' => $SKB->id,
            'order' => 22,
            'title' => '提现管理',
            'icon' => 'fa-dollar',
            'uri' => 'skb_present_record'
        ]);

        // 水可邦-会员管理

        $VIP = Menu::firstOrCreate([
            'uri' => 'vip-users'
        ], [
            'parent_id' => 0,
            'order' => 18,
            'title' => '会员管理',
            'icon' => 'fa-vimeo',
            'uri' => 'vip-users'
        ]);

        // 水可邦-意见反馈

        $Suggestions = Menu::firstOrCreate([
            'uri' => 'suggestions'
        ], [
            'parent_id' => 0,
            'order' => 99,
            'title' => '意见反馈',
            'icon' => 'fa-mail-reply-all',
            'uri' => 'suggestions'
        ]);
    }
}
