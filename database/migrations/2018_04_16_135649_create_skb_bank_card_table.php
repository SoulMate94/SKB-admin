<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbBankCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_bank_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_id')->comment('师傅ID');
            $table->string('real_name')->comment('真实姓名');
            $table->string('id_number')->comment('身份证号');
            $table->char('bank_reserve_mobile')->comment('银行预留手机号');
            $table->string('bank')->comment('银行名称缩写')->nullable();
            $table->string('bank_card_number')->comment('银行卡号');
            $table->string('bank_name')->comment('开户银行名称');
            $table->string('bank_branch_name')->comment('开户支行名称');
            $table->string('card_type_name')->comment('银行卡类型')->nullable();
            $table->string('bank_logo')->comment('银行卡LOGO')->nullable();
            $table->tinyInteger('is_verify')->comment('是否审核通过,0表示未审核,1表示已经审核');
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
        Schema::dropIfExists('skb_bank_card');
    }
}
