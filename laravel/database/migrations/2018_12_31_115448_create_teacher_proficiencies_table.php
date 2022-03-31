<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherProficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_proficiencies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('teacher_id');
            $table->integer('curriculumn_id');
            $table->integer('experience');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_proficiencies');
    }
}
