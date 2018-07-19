<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsWorkToSkbMasterVerify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_master_verify', function (Blueprint $table) {
            $table->tinyInteger('is_work')->comment('是否接单, 默认是接单状态')->default(1);
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
            $table->dropColumn('is_work');
        });
    }
}
