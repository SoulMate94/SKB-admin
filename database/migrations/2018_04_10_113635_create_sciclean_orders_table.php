<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScicleanOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sciclean_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->unique()->comment('订单编号');
            $table->string('kuaidi_number')->unique()->comment('快递编号')->nullable();
            $table->string('product_name')->comment('产品名称');
            $table->string('consignee_name')->comment('收货人姓名');
            $table->char('consignee_tel')->comment('收货人手机号码');
            $table->string('consignee_addr')->comment('收货人地址');
            $table->tinyInteger('product_model')->comment('产品型号,详细看文档');
            $table->float('sale_price')->comment('结算价');
            $table->integer('sale_number')->comment('销售数量');
            $table->integer('consignee_time')->comment('签收时间')->nullable();
            $table->integer('return_time')->comment('退货时间')->nullable();
            $table->tinyInteger('proxy_type')->default('1')->comment('代理类型 1表示个人代理 2经销商');
            $table->tinyInteger('trading_status')->default('1')->comment('交易状态,详细看文档');
            $table->string('salesperson')->comment('销售员名称');
            $table->string('remarks')->comment('备注')->nullable();
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
        Schema::dropIfExists('sciclean_orders');
    }
}
