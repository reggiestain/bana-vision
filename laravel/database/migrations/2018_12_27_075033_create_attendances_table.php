<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('week');
            $table->integer('year');
            $table->boolean('mon')->nullable();
            $table->boolean('tue')->nullable();
            $table->boolean('wed')->nullable();
            $table->boolean('thur')->nullable();
            $table->boolean('fri')->nullable();
            $table->integer('school_id');
            $table->integer('attendable_id');//id of student/teacher in question
            $table->string('attendable_type');// student/teacher/staff memeber
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
