<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoreToCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_comments', function (Blueprint $table) {
            $table->float('service_score')->comment('用户评分,师傅服务态度');
            $table->float('work_score')->comment('用户评分,师傅工作评分');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_comments', function (Blueprint $table) {
            $table->dropColumn('service_score');
            $table->dropColumn('work_score');
        });
    }
}
