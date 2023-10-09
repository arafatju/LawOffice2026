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
        Schema::create('action', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('mobile');
            $table->string('status');
             
            $table->string('time');
            $table->string('action');
            $table->string('id_user');
            $table->string('id_admin');
 
            



        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action');
    }
}
