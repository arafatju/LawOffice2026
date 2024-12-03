<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activitydel extends Migration
{
    /**
     * Run the migrations.
     *district' => Auth::user()->District,
       'mobile' => Auth::user()->mobile,
       'status'=>'Draft',
        'time'=>date("Y-m-d H:i:s", strtotime('now')),
       'nid'=>session('NID'),
       'trname'=>session('tabledr'),
       'avatar'=>$imageName,
     * @return void
     */
    public function up()
    {
        Schema::create('wifeinfo', function (Blueprint $table) {
            $table->id();
             $table->string('userid');
            $table->string('wifename');
             $table->string('wifedesignation');
             $table->string('wifeprofession');
             $table->string('wifeworkplace');
             $table->string('wifehomedistrict');
             $table->string('kids_number');
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
