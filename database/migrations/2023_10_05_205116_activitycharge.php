<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activitycharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('activitycharge', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('mobile');
            $table->string('status');
             
            $table->string('time');
            $table->string('nid');
            $table->string('trname');
            $table->string('avatar');
            $table->string('name');
            $table->string('bortoman');
            $table->string('sector');
  
            



        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitycharge');
    }
}
