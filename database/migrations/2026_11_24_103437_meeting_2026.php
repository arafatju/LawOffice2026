<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();

            // Auto-generated unique string, e.g. MTG-20261124-A7K2QX
            $table->string('meeting_code', 30)->unique();

            // Who created the record (Auth::id()). Add ->constrained('users') if your users.id is a bigint.
            $table->unsignedBigInteger('user_id')->index();

            // ministry | ngo | other  (a directorate is the second level under a ministry)
            $table->string('category', 20)->index();

            // the ministry / NGO / other that was chosen (row in `institutes`)
            $table->foreignId('institute_id')->constrained('institutes')->restrictOnDelete();

            // only for ministry meetings: the directorate (also a row in `institutes`)
            $table->foreignId('directorate_id')->nullable()->constrained('institutes')->restrictOnDelete();

            // participant
            $table->string('participant_name');
            $table->string('participant_email');
            $table->string('participant_mobile', 20);
            $table->string('participant_designation');

            // meeting
            $table->string('meeting_name')->index();
            $table->string('meeting_keyword')->nullable();
            $table->longText('meeting_contents')->nullable();
            $table->boolean('attended')->default(false);   // attendance: yes / no
            $table->dateTime('meeting_at')->index();        // entered manually

            // PDF attachment (stored privately, random file name)
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();  // original name, for display only
            $table->unsignedInteger('attachment_size')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};