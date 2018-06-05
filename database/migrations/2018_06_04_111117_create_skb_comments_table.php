<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('skb_comments');
        Schema::create('skb_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('订单ID');
            $table->string('user_cmt')->comment('用户评论');
            $table->float('user_score')->comment('用户评分')->nullable();
            $table->string('master_cmt')->comment('师傅评论,预留字段')->nullable();
            $table->string('master_score')->comment('师傅评分,预留字段')->nullable();
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
        Schema::dropIfExists('skb_comments');
    }
}
