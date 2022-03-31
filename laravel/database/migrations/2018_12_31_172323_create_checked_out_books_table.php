<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckedOutBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checked_out_books', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('school_id');
            $table->integer('requested_book_id');
            $table->integer('checkedable_id');
            $table->string('checkedable_type');
            $table->date('date_checked_out');
            $table->date('due_date');
            $table->boolean('returned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checked_out_books');
    }
}
