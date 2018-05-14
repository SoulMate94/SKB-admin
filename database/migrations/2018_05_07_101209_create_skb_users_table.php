<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('密码')->nullable();
            $table->string('openid')->comment('微信ID')->nullable();
            $table->string('nickname')->comment('微信昵称,用户昵称');
            $table->string('avatar')->comment('微信头像,用户头像');
            $table->char('mobile')->comment('微信手机号,用户手机号')->nullable();
            $table->tinyInteger('is_del')->default('0')->comment('1表示删除,0表示未删除');
            $table->tinyInteger('role')->default('1')->comment('1表示仅是用户,2表示仅是师傅,3表示两者皆是');
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
        Schema::dropIfExists('skb_users');
    }
}
