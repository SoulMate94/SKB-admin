<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbServiceCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_service_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_active')->default(1)->comment('是否激活,1表示激活');
            $table->string('title')->comment('服务类别名称');
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
        Schema::dropIfExists('skb_service_cate');
    }
}
