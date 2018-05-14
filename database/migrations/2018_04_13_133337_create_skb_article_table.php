<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->comment('文章分类');
            $table->string('title')->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->string('author')->default('匿名')->comment('文章作者');
            $table->tinyInteger('is_top')->comment('是否置顶')->nullable();
            $table->tinyInteger('is_release')->comment('是否发布');
            $table->tinyInteger('order')->default('99')->comment('排序');
            $table->string('seo_title')->comment('SEO优化标题')->nullable();
            $table->string('seo_keywords')->comment('SEO优化关键字')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skb_article');
    }
}
