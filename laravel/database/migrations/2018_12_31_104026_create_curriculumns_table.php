<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculumns', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('school_id');
            $table->string('subject');
            $table->integer('grade');
            $table->boolean('has_practicals')->nullable();
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculumns');
    }
}
