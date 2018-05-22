<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbProductCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_product_cate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('产品类别名称');
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
        Schema::dropIfExists('skb_product_cate');
    }
}
