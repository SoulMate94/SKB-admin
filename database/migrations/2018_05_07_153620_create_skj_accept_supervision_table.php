<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkjAcceptSupervisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skj_accept_supervision', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suggestion_id');
            $table->decimal('charge',9,2)->comment('收费金额,为0表示没有收费')->default(0);
            $table->unsignedInteger('promise_visit_time')->comment('约定上门时间');
            $table->unsignedInteger('actual_visit_time')->comment('实际上门时间')->nullable();
            $table->integer('exceed_time')->comment('超出时限')->default(0);
            $table->tinyInteger('service_attitude')
                ->comment('服务态度:1,很好;2,较好;3,一般;4,差;5,很差')->nullable();
            $table->boolean('is_test')->comment('是否对设备进行调试并保证正常使用')->nullable();
            $table->boolean('is_clean')->comment('是否对安装后现场进行清洁')->nullable();
            $table->boolean('is_guide')->comment('是否对您进行设备使用指导并告知相关注意事项')->nullable();
            $table->string('pipeline_location_map')
                ->comment('提供管路位置图所需的邮箱地址,如果为空则表示用户不需要提供管路位置图')->nullable();
            $table->text('user_advice')->comment('用户建议')->nullable();
            $table->boolean('user_signature')->comment('客户是否签名')->default(0);
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
        Schema::dropIfExists('skj_accept_supervision');
    }
}
