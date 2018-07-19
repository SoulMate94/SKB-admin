<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbWithdrawLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_withdraw_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mid')->comment('师傅ID');
            $table->smallInteger('waid')->comment('提现账户ID => withdraw_accounts.id');
            $table->mediumInteger('amount')->comment('提现金额数（单位：分）');
            $table->tinyInteger('status')->default('1')->comment('提现状态:waiting;processing;failed;success;expired');
            $table->decimal('balance')->comment('用户本次申请提现后的当前可用余额');
            $table->char('ipv4')->comment('用户提现时的客户端IP');
            $table->text('notes')->comment('备注');
            $table->string('id_number')->comment('用户提现时的身份证号');
            $table->tinyInteger('payee_type')->default('1')->comment('1表示银行卡, 2表示支付宝');
            $table->string('payee_account')->comment('收款人账户');
            $table->char('mobile')->comment('收款人号码');
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
        Schema::dropIfExists('skb_withdraw_log');
    }
}
