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
            $table->string('filter_name')->comment('滤芯名称');
            $table->string('user_name')->comment('用户名称');
            $table->string('master_name')->comment('师傅名称');
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
