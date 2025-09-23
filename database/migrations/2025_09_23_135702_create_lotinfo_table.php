<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotinfo', function (Blueprint $table) {
            $table->id();
            $table->string('lotnumber')->unique();
            $table->string('prcode');
            $table->string('purchaseddate');
            $table->string('purchasedtype');
            $table->integer('quantity');

            $table->timestamps();
            
            // Optional: Add indexes for better performance
            $table->index('lotnumber');
            $table->index('prcode');
            $table->index('purchaseddate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotinfo');
    }
}
