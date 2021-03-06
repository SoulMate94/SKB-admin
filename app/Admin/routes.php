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
            'skb_article_list'        => SkbArticleController::class, // by caoxl
            // 水可邦 文章分类
            'skb_article_cate'        => SkbArticleCateController::class,  // by caoxl
            // 水可邦 广告管理
            'skb_ad'                  => SkbAdController::class,  // by caoxl
            // 水可邦 地址管理
            'skb_address'             => SkbAddressController::class,  // by caoxl
            // 意见反馈V1
            'suggestions'             => SkbSuggestionsController::class,  // by caoxl
            // 水可邦 区域开放设置
            'skb_open_area'           => SkbOpenAreaController::class,  // by caoxl
            // 水可邦 产品类别
            'skb_product_cate'        => SkbProductCateController::class,  // by caoxl
            // 水可邦 产品管理
            'skb_product'             => SkbProductController::class,  // by caoxl
            // 水可邦 订单管理
            'skb_order'               => SkbOrdersController::class,  // by caoxl
            // 水可邦 标签分类
            'skb_tags_cate'           => SkbTagsCateController::class,  // by caoxl
            // 水可邦 标签列表
            'skb_tags_list'           => SkbTagsListController::class,  // by caoxl
        ]);
    });

    // 水可邦 系统部分
    $router->group([
        'namespace' => 'SKB\System',
    ], function ($router) {
        $router->resources([

            // 水可邦 消息管理
            'skb_system_message'      => MessageController::class,    // by jizw
        ]);
    });

    // 水可邦 师傅端
    $router->group([
        'namespace' => 'SKB\Master',
    ], function ($router) {
        $router->resources([

            // 水可邦 银行卡管理
            'skb_bank_card'          => SkbBankCardController::class,  // by caoxl
            // 水可邦 支付宝管理
            'skb_alipay'             => SkbAlipayController::class,  // by caoxl
            // 水可邦 提现申请
            'skb_withdraw_log'       => SkbWithdrawLogController::class,  // by caoxl
            // 水可邦 服务类别
            'skb_service_cate'       => SkbServiceCateController::class,  // by caoxl
            // 水可邦 师傅认证
            'skb_master_verify'      => SkbMasterVerifyController::class,    // by jizw
            // 水可邦 意见反馈V2
            'skb_feedback'           => SkbFeedbackController::class, // by caoxl
        ]);
    });

    // 水可邦 用户端
    $router->group([
        'namespace' => 'SKB\User',
    ], function ($router) {
        $router->resources([

            // 水可邦 评论管理
            'skb_cmt'                 => SkbCommentsController::class, // by caoxl
            // 水可邦 意见反馈V3
            'skb_feedback_user'       => SkbFeedbackUserController::class, // by caoxl

        ]);
    });

    // 水可净
    $router->group([
        'namespace' => 'SKJ',
    ], function ($router) {
        $router->resources([

            // 水可净 订单管理
            'skj_orders'             => ScicleanOrdersController::class,  // by caoxl
            // 水可净 分类管理
            'skj_cate'               => ScicleanCatesController::class, // by caoxl
            // 水可净 价格管理
            'skj_price'              => ScicleanPriceController::class, // by caoxl
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
            'skb_clean_type'         => SkbCleanTypeController::class,  // by caoxl
            // 售后 滤芯列表
            'skb_filter'             => SkbFilterController::class,  // by caoxl
            // 售后 滤芯等级
            'skb_filter_level'       => SkbFilterLevelController::class,  // by caoxl
            // 售后 售后服务申请
            'after_sale_list'        => AfterSaleListController::class,  // by caoxl
            // 售后 滤芯安装记录
            'skb_filter_install'     => SkbFilterInstallController::class,  // by caoxl

        ]);
    });

    // 用户管理
    $router->resources([

        // 水可邦 用户管理
        'skb_users'                  => SkbUsersController::class,  // by caoxl


    ]);

    // 其他
    $router->get('after_sale_list/{id}/show', 'AfterSale\AfterSaleListController@show');  // by caoxl

    $router->get('skj_manage_solution/{id}/show', 'SKj\SkjManageSolutionController@show');  // by jizw

    $router->get('skb/area/city', 'SKB\Common\SkbOpenAreaController@city');  // by caoxl

    $router->get('skb/area/district', 'SKB\Common\SkbOpenAreaController@district');  // by caoxl

    $router->get('skb/master/verify/productType', 'SKB\Master\SkbMasterVerifyController@productType');

});
