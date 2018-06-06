<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('skb_product');
        Schema::create('skb_product', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('product_cate_id')->comment('产品类别ID');
            $table->string('product_name')->comment('产品名称');
            $table->string('product_img')->comment('产品图片');
            $table->string('product_exp')->comment('产品说明')->nullable();
            $table->tinyInteger('is_active')->default('1')->comment('是否可用,1表示可用');
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
        Schema::dropIfExists('skb_product');
    }
}
