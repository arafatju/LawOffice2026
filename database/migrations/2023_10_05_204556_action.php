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
        Schema::create('officeinfo', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('designation');
            $table->string('userid');
             
           
 
            



        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officeinfo');
    }
}
