<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkjManageSolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skj_manage_solution', function (Blueprint $table) {
            $table->increments('id');
            $table->float('tds',4,1)->comment('TDS值');
            $table->float('y_tds',4,1)->comment('预估TDS值');
            $table->float('ph',3,1)->comment('PH值');
            $table->float('y_ph',3,1)->comment('预估PH值');
            $table->string('water_quality')->comment('水质情况');
            $table->string('y_water_quality')->comment('预估水质情况');
            $table->string('water_way')->comment('水路评估');
            $table->string('y_water_way')->comment('预估水路评估');
            $table->string('water_pipe')->comment('水管现状');
            $table->string('y_water_pipe')->comment('预估水管现状');
            $table->string('bathroom_products')->comment('卫浴产品');
            $table->string('y_bathroom_products')->comment('预估卫浴产品');
            $table->text('overall_water_quality')->comment('整体水质管理情况概述');
            $table->text('water_quality_suggestion')->comment('专业饮用水质管理建议');
            $table->string('user_demand')->comment('用户需求');
            $table->integer('install_time')->comment('施工日期');
            $table->text('solution')->comment('工程部回复');
            $table->integer('solution_owner_id')->comment('解决方案的人的id')->nullable();
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
        Schema::dropIfExists('skj_manage_solution');
    }
}
