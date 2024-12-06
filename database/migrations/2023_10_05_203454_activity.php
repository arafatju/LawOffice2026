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
            $table->string('marital_status');
            $table->string('join');
            $table->string('retired');
            $table->string('email')->unique();
            $table->string('serviceid')->unique();
            $table->string('gradation')->unique();
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
