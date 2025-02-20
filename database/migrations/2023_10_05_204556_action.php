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
            $table->string('status');
             
            $table->string('userid');
             
            $table->string('applicationid');
 
            



        
        
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
