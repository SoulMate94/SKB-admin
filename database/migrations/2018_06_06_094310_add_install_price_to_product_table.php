<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstallPriceToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skb_product', function (Blueprint $table) {
            $table->float('install_price')->comment('建议安装价格')->nullable();
            $table->float('uninstall_price')->comment('建议拆装价格')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skb_product', function (Blueprint $table) {
            $table->dropColumn('install_price');
            $table->dropColumn('uninstall_price');
            $table->dropColumn('product_price');
        });
    }
}
