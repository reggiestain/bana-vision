<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteExplanationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_explanations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('highlight_start');
            $table->integer('highlight_end');
            $table->integer('note_id');
            $table->text('body');//the explanation for the highlighted text
            $table->string('explanation_url');//url where more detail explanation is present
            $table->integer('user_id');//user id of person doing the explanation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_explanations');
    }
}
