<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('registration_number');
            $table->string('business_entity');
            $table->string('registration_country');
            $table->string('registered_address_country');
            $table->string('registered_address_province');
            $table->string('registered_address_town');
            $table->string('registered_address_address');
            $table->string('registered_address_area_code');
            $table->string('business_place_country');
            $table->string('business_place_province');
            $table->string('business_place_town');
            $table->string('business_place_address');
            $table->string('business_place_area_code');
            $table->string('telephone');
            $table->string('web_url');
            $table->text('values');
            $table->text('services');
            $table->string('sector');
            $table->string('year_established');
            $table->text('mission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
