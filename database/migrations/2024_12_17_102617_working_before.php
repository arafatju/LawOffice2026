<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WorkingBefore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_before', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('userid');  
            $table->string('district');  
            $table->string('designation');  
            $table->string('mobile');  
            $table->string('status');  // empty or present
            $table->string('situation'); // now  or previous
            $table->string('start'); 
            
            $table->string('status2');
            $table->string('GO_Date'); 
            $table->string('sarok');
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
        Schema::dropIfExists('working_before');
    }
}
