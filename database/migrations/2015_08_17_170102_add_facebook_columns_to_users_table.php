<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* This is the first migration. Before running the migration, we run this script as root:
        CREATE DATABASE faces;
        CREATE USER 'faces'@'localhost' IDENTIFIED BY 'PUT_PASSWORD_HERE';
        GRANT ALL PRIVILEGES ON faces . * TO 'faces'@'localhost';
        FLUSH PRIVILEGES;
        */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            //for facebook sdk
            $table->bigInteger('facebook_user_id')->unsigned()->index();
            $table->string('access_token')->nullable();
            //end for facebook sdk
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
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
        Schema::drop('password_resets');
    }
}
