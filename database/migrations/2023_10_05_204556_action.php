<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Action extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   
    public function up()
    {
        Schema::create('apllicationinfo', function (Blueprint $table) {
            $table->id();
            
             
            $table->string('userid');
             
            $table->string('action') ;
            $table->string('role');
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('apllicationinfo');
    }
}
