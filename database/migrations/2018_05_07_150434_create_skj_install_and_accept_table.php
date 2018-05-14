<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkjInstallAndAcceptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skj_install_and_accept', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suggestion_id');
            $table->integer('install_date')->comment('施工日期')->nullable();
            $table->integer('install_people')->comment('施工人数')->nullable();
            $table->integer('install_time_consuming')->comment('安装耗时');
            $table->string('product_list')->comment('产品清点')->nullable();
            $table->boolean('is_accord_map')->comment('按图施工');
            $table->string('change_section')->comment('更改部分:按图施工为true则可以为空')->nullable();
            $table->tinyInteger('installed_result')->comment('安装结果:1,正常使用;2,出现异常;3,其它');
            $table->string('abnormal_desction')->comment('异常描述')->nullable();
            $table->boolean('is_repair')->comment('是否修复')->nullable();
            $table->string('is_use_train')->comment('使用培训');
            $table->boolean('is_take_picture')->comment('拍摄安装图');
            $table->float('raw_water_TDS')->comment('原水TDS');
            $table->float('raw_water_PH')->comment('原水PH');
            $table->float('raw_water_pressure')->comment('原水压力');
            $table->float('pure_water_TDS')->comment('纯水TDS');
            $table->float('pure_water_PH')->comment('纯水PH');
            $table->float('pure_water_flow')->comment('纯水净流量');
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
        Schema::dropIfExists('skj_install_and_accept');
    }
}
