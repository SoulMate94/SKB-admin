<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('下单用户ID');
            $table->integer('mid')->comment('接单师傅ID')->nullable();
            $table->string('order_number')->comment('订单编号');
            $table->tinyInteger('order_status')->comment('订单状态,0是待接单');
            $table->string('service_id')->comment('服务ID');
            $table->string('product_info')->comment('商品详情,包括商品ID,商品图片,商品数量,商品备注');
            $table->integer('start_addr')->comment('始发地ID')->nullable();
            $table->integer('end_addr')->comment('目的地ID');
            $table->tinyInteger('orderby')->comment('排序');
            $table->integer('appoint_time')->comment('预约时间');
            $table->float('total_price')->comment('订单总价,也是最后成交价格');
            $table->float('user_price')->comment('用户报价')->nullable();
            $table->float('master_price')->comment('师傅报价')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skb_orders');
    }
}
