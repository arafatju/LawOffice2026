<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Loginfo extends Migration
{
    
    public function up()
    {
        Schema::create('loginfo', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('mobile');
            $table->string('mail');
            $table->string('time');
            $table->string('Device');
            $table->string('Browser');
            $table->string('ip');
            $table->string('Location');
             
                                                               });
    }

    
    public function down()
    {
        Schema::dropIfExists('loginfo');
    }
}
