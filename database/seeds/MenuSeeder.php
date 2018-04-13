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

        // 水可净
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

        // 水可邦
        $SKB = Menu::firstOrCreate([
            'uri' => 'skb'
        ], [
            'parent_id' => 0,
            'order' => 17,
            'title' => '水可邦',
            'icon' => 'fa-bold',
            'uri' => 'skb'
        ]);

        // 会员管理

        $VIP = Menu::firstOrCreate([
            'uri' => 'vip-users'
        ], [
            'parent_id' => 0,
            'order' => 18,
            'title' => '会员管理',
            'icon' => 'fa-vimeo',
            'uri' => 'vip-users'
        ]);

        // 意见反馈

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
