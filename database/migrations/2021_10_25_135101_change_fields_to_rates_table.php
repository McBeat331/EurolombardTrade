<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsToRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->string('currency_from');
            $table->string('currency_to');

            $table->float('buy_opt')->nullable();
            $table->float('sale_opt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->string('currency');
            $table->dropColumn(['currency_from','currency_to','buy_opt','sale_opt']);
        });
    }
}
