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
            $table->string('userid');
            $table->string('mobile');
            $table->string('name');
            $table->string('marital_status');
            $table->string('father');
            $table->string('mother');
            $table->string('email');
            $table->string('officeid');
            $table->string('homedistrict');

            $table->string('permanentaddress');

            
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
