<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kazipicture extends Migration
{
     
    public function up()
    {
        Schema::create('notaryinfo', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('barnumber');
            $table->string('bardate');
            $table->string('lawnumber');
            $table->string('lawdate');
            $table->string('exp');
            $table->string('notarysarok'); // class 1 2 school(1-6)- 6-10 college univ 
            $table->string('natarydate');
            $table->string('area');  //varsity name
            $table->string('renewdate'); 
            $table->string('lastrenewdate'); 
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
        Schema::dropIfExists('notaryinfo');
    }
}
