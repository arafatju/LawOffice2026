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
        Schema::create('activityedit', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('mobile');
            $table->string('status');
            $table->string('colname');
            $table->string('after');
            $table->string('time');
            $table->string('nid');
            $table->string('trname');
            $table->string('heading');
            $table->string('bortoman');
                                                               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activityedit');

    }
}
