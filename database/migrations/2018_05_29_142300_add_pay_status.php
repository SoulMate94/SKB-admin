<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_orders', function (Blueprint $table) {
            $table->tinyInteger('pay_status')->comment('支付状态,0是未支付,-1是支付失败');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_orders', function (Blueprint $table) {
            $table->dropColumn('pay_status');
        });
    }
}
