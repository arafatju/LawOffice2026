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
            $table->string('father');
            $table->string('mother');
            $table->string('dob');
            $table->string('permanent');
            $table->string('nid');
            $table->string('district');
           
            $table->string('present');
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
