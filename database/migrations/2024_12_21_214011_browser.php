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
        Schema::create('device_details', function (Blueprint $table) {
            $table->id();
            $table->string('userid');  
            $table->string('browser');  
            $table->string('browser_version');  
            $table->string('device'); //30 words
            $table->string('device_version');
            $table->string('ip');
            $table->string('region');
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
         
            Schema::dropIfExists('device_details');
         
    }
}
