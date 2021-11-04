<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->boolean('isOpt')->default(0);

            $table->dropForeign('orders_address_id_foreign');
            $table->dropColumn('address_id');

            $table->dropColumn('currency_from');
            $table->dropColumn('currency_to');
            $table->dropColumn('rate_from');
            $table->dropColumn('rate_to');
            $table->dropColumn('price_from');
            $table->dropColumn('price_to');

            $table->string('currency_sale');
            $table->string('currency_buy');
            $table->float('rate_sale');
            $table->float('rate_buy');
            $table->float('price_sale');
            $table->float('price_buy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn('currency_sale');
            $table->dropColumn('currency_buy');
            $table->dropColumn('rate_sale');
            $table->dropColumn('rate_buy');
            $table->dropColumn('price_sale');
            $table->dropColumn('price_buy');

            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
    }
}
