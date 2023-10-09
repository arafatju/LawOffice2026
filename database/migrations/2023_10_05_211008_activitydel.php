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
        Schema::create('activitydel', function (Blueprint $table) {
            $table->id();
             $table->string('mobile');
            $table->string('status');
             $table->string('time');
            $table->string('nid');
            $table->string('trname');
            $table->string('avatar');
                                                                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activitydel');
    }
}
