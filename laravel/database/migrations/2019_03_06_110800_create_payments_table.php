<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('m_payment_id');
            $table->integer('amount');
            $table->string('item_name');
            $table->string('item_description');
            $table->integer('user_id');//value taken from custom_int1
            $table->integer('pricing_id');//value taken from custom_int2
            $table->string('token');
            $table->string('payment_status');
            $table->integer('pf_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
