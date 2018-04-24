<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_filter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level_id')->comment('滤芯等级ID');
            $table->string('filter_name')->comment('滤芯名称');
            $table->string('filter_model')->comment('滤芯产品名称');
            $table->integer('filter_life')->comment('滤芯寿命');
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
        Schema::dropIfExists('skb_filter');
    }
}
