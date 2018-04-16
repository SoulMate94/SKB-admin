<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_ad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('广告标题');
            $table->string('image')->comment('广告图片');
            $table->string('thumb')->comment('广告缩略图片')->nullable();
            $table->string('url')->comment('广告跳转链接');
            $table->tinyInteger('ad_position')->default('1')->comment('广告位');
            $table->tinyInteger('order')->default('99')->comment('排序');
            $table->string('ad_explain')->comment('广告说明')->nullable();
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
        Schema::dropIfExists('skb_ad');
    }
}
