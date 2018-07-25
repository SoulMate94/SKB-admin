<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsUseToskbSystemFormId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_system_form_id', function (Blueprint $table) {
            $table->tinyInteger('is_use')->default(0)->comment('是否使用,0:未使用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_system_form_id', function (Blueprint $table) {
            //
        });
    }
}
