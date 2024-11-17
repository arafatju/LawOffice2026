<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_budget', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('code11');  
            $table->string('username');  
            $table->string('email');  
            $table->string('mobile');  
            $table->string('District');  
            $table->string('Designation'); 
            $table->string('status'); 
            $table->string('financial2324'); 
            $table->bigInteger('allotment');  
            $table->bigInteger('allotment2');  
            $table->string('opinion');  
              
            $table->string('financial2425'); 
            $table->string('applicationid');
            $table->rememberToken();
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget');
    }
}
