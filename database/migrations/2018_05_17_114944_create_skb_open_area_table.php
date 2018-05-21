<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbOpenAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_open_area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->string('district')->comment('区')->nullable();
            $table->string('street')->comment('街道')->nullable();
            $table->tinyInteger('is_open')->default('1')->comment('是否开放,默认开放');
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
        Schema::dropIfExists('skb_open_area');
    }
}
