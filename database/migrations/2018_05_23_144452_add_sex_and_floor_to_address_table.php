<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSexAndFloorToAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_address', function (Blueprint $table) {
            $table->tinyInteger('sex')->comment('性别, 1表示男，2表示女，3表示未知')->default(1);
            $table->tinyInteger('floor')->comment('楼层')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_address', function (Blueprint $table) {
            $table->dropColumn('sex');
            $table->dropColumn('floor');
        });
    }
}
