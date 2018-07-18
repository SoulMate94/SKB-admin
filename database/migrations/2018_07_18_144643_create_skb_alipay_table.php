<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbAlipayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_alipay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_id')->comment('师傅ID');
            $table->string('real_name')->comment('真实姓名');
            $table->string('alipay_account')->comment('支付宝账号');
            $table->tinyInteger('is_verify')->comment('是否通过审核, 1表示通过');
            $table->string('refuse')->comment('拒绝原因')->nullable();
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
        Schema::dropIfExists('skb_alipay');
    }
}
