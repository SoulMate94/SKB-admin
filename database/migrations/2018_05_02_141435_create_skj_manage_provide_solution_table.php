<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkjManageProvideSolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skj_manage_provide_solution', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suggestion_id');
            $table->string('product',64)->comment('产品');
            $table->string('features',64)->comment('功能');
            $table->integer('quantity')->comment('数量');
            $table->decimal('unit',9,2)->comment('单价');
            $table->decimal('price',9,2)->comment('报价');
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
        Schema::dropIfExists('skj_manage_provide_solution');
    }
}
