<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 水可邦 公共部分
    $router->group([
        'namespace' => 'SKB\Common',
    ], function ($router) {
        $router->resources([

            // 水可邦 文章列表
            'skb_article_list'        => SkbArticleController::class,
            // 水可邦 文章分类
            'skb_article_cate'        => SkbArticleCateController::class,
            // 水可邦 广告管理
            'skb_ad'                  => SkbAdController::class,
            // 水可邦 地址管理
            'skb_address'             => SkbAddressController::class,
            // 意见反馈
            'suggestions'             => SkbSuggestionsController::class,
            // 水可邦 区域开放设置
            'skb_open_area'           => SkbOpenAreaController::class,

        ]);
    });

    // 师傅端
    $router->group([
        'namespace' => 'SKB\Master',
    ], function ($router) {
        $router->resources([

            // 水可邦 银行卡管理
            'skb_bank_card'          => SkbBankCardController::class,
            // 水可邦 服务类别
            'skb_service_cate'       => SkbServiceCateController::class,

        ]);
    });

    // 水可净
    $router->group([
        'namespace' => 'SKJ',
    ], function ($router) {
        $router->resources([

            // 水可净 订单管理
            'skj_orders'             => ScicleanOrdersController::class,
            // 水可净 分类管理
            'skj_cate'               => ScicleanCatesController::class,
            // 水可净 价格管理
            'skj_price'              => ScicleanPriceController::class,
            // 水可净 水质解决方案调查系统
            'skj_solution_question'  => SkjSolutionQuestionController::class,  // by jizw
            // 水可净 质量管理系统
            'skj_manage_solution'    => SkjManageSolutionController::class,  // by jizw
            // 水可净 水质管理安装验收系统
            'skj_install_and_accept' => SkjInstallAndAcceptController::class,  // by jizw

        ]);
    });

    // 售后服务
    $router->group([
        'namespace' => 'AfterSale',
    ], function ($router) {
        $router->resources([

            // 水可邦 净水器机型
            'skb_clean_type'         => SkbCleanTypeController::class,
            // 售后 滤芯列表
            'skb_filter'             => SkbFilterController::class,
            // 售后 滤芯等级
            'skb_filter_level'       => SkbFilterLevelController::class,
            // 售后 售后服务申请
            'after_sale_list'        => AfterSaleListController::class,
            // 售后 滤芯安装记录
            'skb_filter_install'     => SkbFilterInstallController::class,

        ]);
    });

    // 用户管理
    $router->resources([

        // 水可邦 用户管理

        'skb_users'                  => SkbUsersController::class,


    ]);

    // 其他
    $router->get('after_sale_list/{id}/show', 'AfterSale\AfterSaleListController@show');

    $router->get('skj_manage_solution/{id}/show', 'SKj\SkjManageSolutionController@show');  // by jizw

    $router->get('skb/area/city', 'SKB\Common\SkbOpenAreaController@city');

    $router->get('skb/area/district', 'SKB\Common\SkbOpenAreaController@district');

});
