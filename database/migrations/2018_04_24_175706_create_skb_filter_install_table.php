<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbFilterInstallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_filter_install', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filter_id')->comment('滤芯ID');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('master_id')->comment('师傅ID');
            $table->timestamp('installed_at')->comment('安装时间');
            $table->timestamp('expired_at')->comment('更换时间')->nullable();
            $table->integer('expired_time')->comment('滤芯更换时间倒计时');
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
        Schema::dropIfExists('skb_filter_install');
    }
}
