<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Browser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment', function (Blueprint $table) {
            $table->id();
           
            $table->string('prcode');  
            $table->integer('quantity');  
               $table->string('designation');
               
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
         
            Schema::dropIfExists('allotment');
         
    }
}
