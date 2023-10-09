<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Userstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique;
            $table->string('name');
            $table->string('password');
            $table->string('Designation')->unique;
            $table->string('District');
            $table->string('Device');
            $table->string('Location')->unique;
            $table->string('mobile');
            $table->string('avatar');
            $table->string('role');  


             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

    }
}
