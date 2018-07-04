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
            // $table->string('user_nit',100)->unique();
            $table->string('user_name',100);
            $table->string('user_lastname', 100);
            $table->string('username', 10)->unique();
            $table->string('user_email', 100);
            $table->string('user_telephone', 100);
            $table->string('user_address', 100);
            $table->string('password', 100);
            $table->rememberToken();
            $table->timestamps();
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
