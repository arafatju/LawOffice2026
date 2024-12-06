<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activitydel extends Migration
{
     
    public function up()
    {
        Schema::create('wifeinfo', function (Blueprint $table) {
            $table->id();
             $table->string('userid')->unique();
            $table->string('wifename');
             $table->string('profession');
             $table->string('designation');
             $table->string('wifeworkplace');
             $table->string('wifehomedistrict');
             $table->string('kids_number');
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
        Schema::dropIfExists('wifeinfo');
    }
}
