<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbCleanTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_clean_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name')->comment('产品名称');
            $table->string('product_img')->comment('产品图片');
            $table->string('level_1')->comment('第一级')->nullable();
            $table->string('level_2')->comment('第二级')->nullable();
            $table->string('level_3')->comment('第三级')->nullable();
            $table->string('level_4')->comment('第四级')->nullable();
            $table->string('level_5')->comment('第五级')->nullable();
            $table->string('level_6')->comment('第六级,预留')->nullable();
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
        Schema::dropIfExists('skb_clean_type');
    }
}
