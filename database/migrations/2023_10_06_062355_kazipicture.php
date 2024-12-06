<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kazipicture extends Migration
{
     
    public function up()
    {
        Schema::create('childinfo', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('name');
            $table->string('age');
            $table->string('educationtype'); // class 1 2 school(1-6)- 6-10 college univ 
            $table->string('educationlocation');
            $table->string('educationname');  //varsity name
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
        Schema::dropIfExists('userpicture');
    }
}
