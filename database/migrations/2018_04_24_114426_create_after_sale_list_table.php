<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfterSaleListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('after_sale_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apply_name')->comment('申请人名称');
            $table->string('apply_mobile')->comment('申请人手机号');
            $table->string('apply_addr')->comment('申请人地址');
            $table->string('service_type')->comment('售后类型');
            $table->tinyInteger('service_cate_id')->comment('服务类别');
            $table->string('filter_level_1')->comment('一级滤芯')->nullable();
            $table->string('filter_level_2')->comment('二级滤芯')->nullable();
            $table->string('filter_level_3')->comment('三级滤芯')->nullable();
            $table->string('filter_level_4')->comment('四级滤芯')->nullable();
            $table->string('filter_level_5')->comment('五级滤芯')->nullable();
            $table->string('filter_pre')->comment('前置滤芯')->nullable();
            $table->integer('service_master_id')->comment('服务师傅')->nullable();
            $table->string('remark')->comment('备注')->nullable();
            $table->string('after_ sale_countdown')->comment('售后倒计时')->nullable();
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
        Schema::dropIfExists('after_sale_list');
    }
}
