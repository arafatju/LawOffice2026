<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sms_logs', function (Blueprint $table) {
    $table->id();
    $table->string('trid', 50)->nullable()->index();   // transaction id
    $table->string('userid', 50)->nullable()->index();
    $table->string('mobile', 20);
    $table->text('message');
    $table->string('status', 10)->index();             // sent | failed
    $table->string('response', 500)->nullable();       // API reply or error
    $table->timestamp('sent_at')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}
