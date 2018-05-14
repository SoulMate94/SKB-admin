<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户ID');
            $table->string('area')->comment('区域');
            $table->string('addr')->comment('具体地址');
            $table->string('contacts')->comment('联系人');
            $table->char('contacts_mobile')->comment('联系人手机号');
            $table->tinyInteger('tag')->comment('标签,1表示家,2表示公司')->nullable();
            $table->tinyInteger('is_default')->comment('是否默认地址,1表示默认');
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
        Schema::dropIfExists('skb_address');
    }
}
