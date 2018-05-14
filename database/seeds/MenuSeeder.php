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
            'uri' => 'skb'
        ], [
            'parent_id' => 0,
            'order' => 17,
            'title' => '水可邦',
            'icon' => 'fa-bold',
            'uri' => 'skb'
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

        $SKB_address = Menu::firstOrCreate([
            'uri' => 'skb_address'
        ], [
            'parent_id' => $SKB->id,
            'order' => 25,
            'title' => '地址管理',
            'icon'  => 'fa-map-marker',
            'uri'  => 'skb_address'
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

        // 水可邦-服务类别
        Menu::firstOrCreate([
            'uri' => 'skb_service_cate'
        ], [
            'parent_id' => $SKB->id,
            'order' => 19,
            'title' => '服务类别',
            'icon' => 'fa-list-ul',
            'uri' => 'skb_service_cate'
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

        // 水可邦--用户端--start
        $SkbUser = Menu::firstOrCreate([
            'uri' => 'skb_user'
        ], [
            'parent_id' => $SKB->id,
            'order' => 99,
            'title' => '用户端',
            'icon'  => 'fa-user-md',
            'uri'   => 'skb_user'
        ]);
        // 水可邦--用户端--end

        // 水可邦--师傅端--start
        $SkbMaster = Menu::firstOrCreate([
            'uri' => 'skb_master'
        ], [
            'parent_id' => $SKB->id,
            'order' => 99,
            'title' => '师傅端',
            'icon'  => 'fa-user-secret',
            'uri'   => 'skb_master'
        ]);
        // 水可邦--师傅端--end

        // 水可邦--end

        // 售后服务系统--start

        $after_sale = Menu::firstOrCreate([
            'uri' => 'after_sale'
        ], [
            'parent_id' => 0,
            'order' => 1,
            'title' => '售后服务系统',
            'icon'  => 'fa-ambulance',
            'uri'   => 'after_sale'
        ]);

        // 售后-滤芯详情
        Menu::firstOrCreate([
            'uri' => 'skb_filter'
        ], [
            'parent_id' => $after_sale->id,
            'order' => 2,
            'title' => '滤芯列表',
            'icon'  => 'fa-th-list',
            'uri'   => 'skb_filter'
        ]);

        // 售后-滤芯等级
        Menu::firstOrCreate([
            'uri' => 'skb_filter_level'
        ], [
            'parent_id' => $after_sale->id,
            'order' => 3,
            'title' => '滤芯等级',
            'icon'  => 'fa-level-down',
            'uri'   => 'skb_filter_level'
        ]);

        // 售后-售后列表
        Menu::firstOrCreate([
            'uri' => 'after_sale_list'
        ], [
            'parent_id' => $after_sale->id,
            'order' => 3,
            'title' => '售后服务申请',
            'icon'  => 'fa-retweet',
            'uri'   => 'after_sale_list'
        ]);

        // 售后-滤芯安装记录
        Menu::firstOrCreate([
            'uri' => 'skb_filter_install'
        ], [
            'parent_id' => $after_sale->id,
            'order' => 3,
            'title' => '滤芯安装/更换记录',
            'icon'  => 'fa-history',
            'uri'   => 'skb_filter_install'
        ]);

        // 净水器机型
        Menu::firstOrCreate([
            'uri' => 'skb_clean_type'
        ], [
            'parent_id' => $after_sale->id,
            'order' => 5,
            'title' => '净水器机型',
            'icon'  => 'fa-glass',
            'uri'   => 'skb_clean_type'
        ]);

        // 售后服务系统--end

        // 用户管理--start
        Menu::firstOrCreate([
            'uri' => 'skb_users'
        ], [
            'parent_id' => 0,
            'order' => 98,
            'title' => '水可邦用户管理',
            'icon'  => 'fa-users',
            'uri'   => 'skb_users'
        ]);
        // 用户管理--end

        //水可净-调查系统--strat

        $AfterMarket = Menu::firstOrCreate(
            ['uri' =>'after_market '],[
            'parent_id' =>$SKJ->id,
            'order' => 99,
            'title' => '水质管理系统',
            'icon' => 'fa-send',
            'uri' => 'after_market'
        ]);
        $SkjSolutionQuestion = Menu::firstOrCreate(
            ['uri' =>'skj_solution_question '],[
            'parent_id' =>$AfterMarket->id,
            'order' => 99,
            'title' => '水质解决方案调查表',
            'icon' => 'fa-align-justify',
            'uri' => 'skj_solution_question'
        ]);
        $SkjManageSolution = Menu::firstOrCreate(
            ['uri' =>'skj_manage_solution '],[
            'parent_id' =>$AfterMarket->id,
            'order' => 99,
            'title' => '水质管理解决方案',
            'icon' => 'fa-balance-scale',
            'uri' => 'skj_manage_solution'
        ]);
        $SkjInstallAndAccept = Menu::firstOrCreate(
            ['uri' =>'skj_install_and_accept '],[
            'parent_id' =>$AfterMarket->id,
            'order' => 99,
            'title' => '水质管理安装验收表',
            'icon' => 'fa-firefox',
            'uri' => 'skj_install_and_accept'
        ]);

        //水可净-调查系统--end
    }
}