<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feedback_name')->comment('反馈人姓名');
            $table->char('feedback_mobile')->comment('反馈人手机号码');
            $table->text('feedback_content')->comment('反馈内容');
            $table->text('reply_content')->comment('回复内容');
            $table->string('reply_name')->comment('回复人');
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
        Schema::dropIfExists('skb_suggestions');
    }
}
