<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Activitynew extends Migration
{
    /**
      'district' => Auth::user()->District,
            'mobile' => Auth::user()->mobile,
            'status'=> "Draft",
             'time'=>date("Y-m-d H:i:s", strtotime('now')),
            'name'=>$request->name,
            'area'=>$request->area,
            'nid'=>$request->nid,
              'avatar'=>'kkll',
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitynew', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('mobile');
            $table->string('status');
            $table->string('name');
            $table->string('area');
            $table->string('time');
            $table->string('nid');
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
        Schema::dropIfExists('activitynew');
    }
}
