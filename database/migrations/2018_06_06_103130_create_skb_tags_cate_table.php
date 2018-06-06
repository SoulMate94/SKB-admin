<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbTagsCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_tags_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('分类标题');
            $table->tinyInteger('is_active')->default('1')->comment('是否激活,1表示激活');
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
        Schema::dropIfExists('skb_tags_cate');
    }
}
