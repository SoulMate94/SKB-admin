<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppealToSkbMasterVerify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_master_verify', function (Blueprint $table) {
            $table->text('appeal')->comment('申诉字段');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_master_verify', function (Blueprint $table) {
            //
        });
    }
}
