<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbTagsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_tags_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->comment('标签分类ID');
            $table->string('tags')->comment('标签内容,以逗号分隔');
            $table->tinyInteger('is_del')->comment('是否删除,1表示删除');
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
        Schema::dropIfExists('skb_tags_list');
    }
}
