<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('origin_country');
            $table->string('operation_area_country');
            $table->string('operation_area_province');
            $table->string('operation_area_town');
            $table->string('operation_area_area_code');
            $table->string('headquarters_country');
            $table->string('headquarters_province');
            $table->string('headquarters_town');
            $table->string('headquarters_area_code');
            $table->string('headquarters_address');
            $table->string('telephone');
            $table->string('web_url');
            $table->string('year_established');
            $table->string('registration_number');
            $table->string('organization_type');
            $table->string('focus');
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
        Schema::dropIfExists('organizations');
    }
}
