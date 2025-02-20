<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activitydel extends Migration
{
     
    public function up()
    {
        Schema::create('educationinfo', function (Blueprint $table) {
            $table->id();
             $table->string('userid')->unique();
            $table->string('sscpass');
             $table->string('hscpass');
             $table->string('edu1');
             $table->string('edu2');
            
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
        Schema::dropIfExists('educationinfo');
    }
}
