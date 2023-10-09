<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kazipicture extends Migration
{
    /**
     * Run the migrations.
     DB::table('kazipicture')->insert([
        'district' => Auth::user()->District,
        'nid'=>session('NID'),
        'picture'=>$imageName,
        'father'=>$fft->E,
        'mother'=>$fft->F,
        'name'=>$fft->D,
    ]);
     * @return void
     */
    public function up()
    {
        Schema::create('kazipicture', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('nid');
            $table->string('picture');
            $table->string('father');
            $table->string('mother');
            $table->string('name');
           
             
                                                               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kazipicture');
    }
}
