<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->string('id_number');
            $table->string('guardian');
            $table->integer('grade');
            $table->string('class');
            $table->integer('year');
            $table->integer('student_number')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('school_id');
            $table->integer('guardian_id')->nullable();
            $table->string('disability');
            $table->string('gender');
            $table->string('special_medication');
            $table->string('medical_condition');
            $table->string('previous_school');
            $table->string('previous_grade');
            $table->integer('previous_school_grade');
            $table->string('major')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_students');
    }
}
