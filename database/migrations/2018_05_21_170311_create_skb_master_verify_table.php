<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbMasterVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_master_verify', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mid')->comment('对应用户ID');
            $table->string('mobile')->comment('师傅手机号');
            $table->string('id_number')->comment('身份证号码');
            $table->string('work_year')->comment('工作年限');
            $table->string('id_card_img')->comment('身份证照片');
            $table->string('work_area')->comment('工作区域');
            $table->json('product_type_id')->comment('产品类别id');
            $table->json('service_type_id')->comment('服务类别id');
            $table->integer('service_end_time')->comment('服务结束时间');
            $table->tinyInteger('is_del')->comment('是否删除,1表示删除');
            $table->tinyInteger('is_verify')->comment('是否认证,1表示通过认证');
            $table->string('failure_reason')->comment('认证失败原因')->nullable();
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
        Schema::dropIfExists('skb_master_verify');
    }
}
