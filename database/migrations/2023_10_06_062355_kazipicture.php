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
        Schema::create('childinfo', function (Blueprint $table) {
            $table->id();
            $table->string('userid');
            $table->string('name');
            $table->string('age');
            $table->string('educationtype'); // class 1 2 school(1-6)- 6-10 college univ 
            $table->string('educationlocation');
            $table->string('educationname');  //varsity name
           
             
                                                               });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userpicture');
    }
}
