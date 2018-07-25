<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbFeedbackUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_feedback_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户ID');
            $table->tinyInteger('feedback_cate')->default('1')->comment('反馈类别;1表示产品, 2表示服务');
            $table->tinyInteger('feedback_type')->default('1')->comment('反馈类型;1表示咨询, 2表示建议,3表示其他');
            $table->text('feedback_content')->comment('反馈内容');
            $table->string('feedback_img')->comment('反馈图片')->nullable();
            $table->string('contacts')->comment('联系人姓名');
            $table->string('contacts_info')->comment('联系方式');
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
        Schema::dropIfExists('skb_feedback_user');
    }
}
