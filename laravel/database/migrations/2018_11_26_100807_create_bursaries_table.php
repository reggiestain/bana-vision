<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBursariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bursaries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->string('title');
            $table->string('closing_date');
            $table->string('application_link');
            $table->string('sector');
            $table->string('positions_available');
            $table->text('description');
            $table->string('address');
            $table->string('country');
            $table->string('suburb');
            $table->string('province');
            $table->string('area_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bursaries');
    }
}
