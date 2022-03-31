<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->integer('usable_id');
            $table->string('usable_type');
            $table->string('activation_code')->nullable();
            $table->boolean('status')->default(0);
            $table->string('slug');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
