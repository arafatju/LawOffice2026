<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mamla extends Migration
{
    /**
     * Run the migrations.
     *'area' => $request->area  ,
            'upojela' => $request->upojela  ,
              'name'=> $request->name  ,
            'father'=> $request->father   ,
            'mother'=>  $request->mother ,
            'dob'=>  $request->dob ,
            'nid' => $request->nid  ,
             'address'=>   $request->permanent ,
             'mobile'=>   $request->mobile,
             'license' =>   $request->dategot,
             'religion'=>   $request->religion,
             'pourosova'=> $request->pourosova,
            'district'=>Auth::user()->District,
             'status'=>'Draft',
             'mamla'=> $request->mamla  ,
     * @return void
     */
    public function up()
    {
        Schema::create('mamla', function (Blueprint $table) {
            $table->id();
            $table->string('upojela');
             $table->string('dob');
            $table->string('father');
            $table->string('mother');
            $table->string('name');
           
            $table->string('mobile');
            $table->string('address');
            $table->string('nid');
 
            $table->string('license');
            $table->string('religion');
            $table->string('pourosova');
            $table->string('district');
            $table->string('status');
            $table->string('mamla');
             
        
        
        
        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mamla');
    }
}
