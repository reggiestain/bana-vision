<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('school_student_id');
            $table->integer('school_id');
            $table->string('field');
            $table->string('description');
            $table->string('year');
            $table->string('awarded_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_awards');
    }
}
