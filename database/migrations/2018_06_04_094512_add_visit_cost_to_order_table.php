<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitCostToOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_orders', function (Blueprint $table) {
            $table->float('visit_cost')->comment('上门费')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_orders', function (Blueprint $table) {
            $table->dropColumn('visit_cost');
        });
    }
}
