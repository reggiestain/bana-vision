<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanaStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bana_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('clearance_level');
            $table->string('employee_id');
            $table->string('date_employed');
            $table->string('employment_type');
            $table->string('position');
            $table->string('seniority_level');
            $table->string('gender');
            $table->string('religion');
            $table->string('duties');
            $table->string('qualifications');
            $table->string('educational_level');
            $table->string('last_employer');
            $table->integer('years_experience_when_joining');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bana_staffs');
    }
}
