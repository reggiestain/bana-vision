<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('school_id');
            $table->string('title');
            $table->string('gender');
            $table->string('name');
            $table->string('surname');
            $table->integer('school_student_id');
            $table->string('contact_number');
            $table->string('postal_address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('street_name');
            $table->string('house_number');
            $table->string('relationship_to_student');
            $table->string('id_number');
            $table->string('employment_status');
            $table->string('job_sector');
            $table->string('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardians');
    }
}
