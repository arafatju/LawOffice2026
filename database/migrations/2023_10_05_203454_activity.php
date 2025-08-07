<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('personalinfo', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->unique();
            $table->string('mobile')->unique();
            $table->string('name');
            $table->string('designation');
             $table->string('designation2');
            $table->string('office');
             
            $table->string('email')->unique();
            
           $table->timestamps()  ;                   
            

            
                                                               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personalinfo');

    }
}
