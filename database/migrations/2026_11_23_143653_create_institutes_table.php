<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();

            // ministry | directorate | ngo | other
            $table->string('type', 20)->index();

            $table->string('name');

            // directorate -> its ministry. Null for ministry / ngo / other.
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('institutes')
                  ->cascadeOnDelete();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            // NOTE: MySQL treats NULL parent_id values as distinct, so duplicate
            // ministries/NGOs are prevented in the controller (firstOrCreate),
            // while duplicate directorates under one ministry are blocked here.
            $table->unique(['type', 'parent_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};