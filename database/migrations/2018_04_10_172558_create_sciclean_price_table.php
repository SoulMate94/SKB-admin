<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScicleanPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sciclean_price', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id')->comment('所属分类ID');
            $table->string('product_name')->comment('产品名称');
            $table->string('product_img')->comment('产品图片');
            $table->float('product_price')->comment('产品价格');
            $table->float('install_price')->comment('建议安装价格');
            $table->tinyInteger('is_del')->comment('是否删除')->default(0);
            $table->text('remarks')->comment('备注');
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
        Schema::dropIfExists('sciclean_price');
    }
}
