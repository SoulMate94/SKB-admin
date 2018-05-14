<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbArticleCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_article_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->comment('上级分类,0为顶级分类')->nullable()->default('0');
            $table->string('title')->comment('分类标题');
            $table->tinyInteger('order')->comment('排序');
            $table->text('remark')->comment('备注,分类说明')->nullable();
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
        Schema::dropIfExists('skb_article_cate');
    }
}
