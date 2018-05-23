<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveToServiceCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_service_cate', function (Blueprint $table) {
            $table->tinyInteger('is_active')->default(1)->comment('是否激活,1表示激活');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_service_cate', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
