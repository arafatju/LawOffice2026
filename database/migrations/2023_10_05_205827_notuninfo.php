<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Notuninfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
   
    ** 'name' => 'required|string',
     'father' => 'required|string',
    'mother' =>  'required|string' ,
    'area' => 'required|string' ,
    
    'mobile' => 'required|string',
    'nid' =>  'required|string' ,
    'dob' => 'required|string' ,
    
    'education' => 'required|string',
    'email' =>  'required|string' ,
    'dategot' => 'required|string' ,
    
    'datelicense' => 'required|string',
    'statuslicense' =>  'required|string' ,
    'join' => 'required|string' ,
    
    'indent' => 'required|string' ,
    'gazetdate' => 'required|string',
    'expired' =>  'required|string' ,
    
    'jobdo' => 'required|string' ,
    'permanent' => 'required|string' ,
    'office' => 'required|string',
    
    'present' =>  'required|string' ,
    'religion' => 'required|string' ,
    'jobname' => 'required|string' ,
      */
    
    public function up()
    {
        Schema::create('notuninfo', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father');
            $table->string('mother');
            // kaj baki aste aste korte hobe 
             
            $table->string('area');
            $table->string('mobile');
            $table->string('nid');
            $table->string('dob');

            $table->string('education');
            $table->string('email');
            $table->string('dategot');

            $table->string('datelicense');
            $table->string('statuslicense');
            $table->string('join');
            
            $table->string('indent');
            $table->string('gazetdate');
            $table->string('expired');
            
            $table->string('jobdo');
            $table->string('permanent');
            $table->string('office');
            
            $table->string('present');
            $table->string('religion');
            $table->string('jobname');
            



        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notuninfo');
    }
}
