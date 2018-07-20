<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_message', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('content')->comment('内容');
            $table->tinyInteger('recipient_id')->comment('收信人id');
            $table->tinyInteger('message_type')->comment('消息种类,纯文本,跳转链接,json,语音');
            $table->tinyInteger('is_read')->comment('是否阅读,null表示没有阅读,1表示已经阅读')->nullable();
            $table->tinyInteger('is_push')->comment('是否推送,null表示没有推送,1表示已经推送')->nullable();
            $table->integer('push_time')->comment('推送时间,可以为空')->nullable();
            $table->string('wechat_recipient_id')->comment('微信内的接收人id')->nullable();
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
        Schema::dropIfExists('skb_message');
    }
}
