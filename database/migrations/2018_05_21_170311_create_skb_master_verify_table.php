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
            $table->string('id_number')->comment('身份证号码');
            $table->integer('work_year')->comment('工作年限,单位:年');
            $table->string('id_card_img')->comment('身份证照片,json格式的字符串');
            $table->string('work_area')->comment('工作区域,json格式的字符串');
            $table->string('product_type_id')->comment('产品类别id,json格式的字符串');
            $table->string('service_type_id')->comment('服务类别id,json格式的字符串');
            $table->integer('service_sta_time')->comment('服务开始时间');
            $table->integer('service_end_time')->comment('服务结束时间');
            $table->tinyInteger('verify_status')
                ->comment('认证状态,0表示未提交认证;1表示已提交认证但未审核;2表示审核成功;-1表示审核未成功')
                ->default(0);
            $table->tinyInteger('is_del')
                ->comment('是否删除,1表示删除')
                ->default(0);
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
