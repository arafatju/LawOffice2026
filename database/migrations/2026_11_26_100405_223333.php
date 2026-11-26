<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            // meeting | seminar | workshop  (existing rows become "meeting" = সভা)
            $table->string('meeting_type', 20)->default('meeting')->after('participant_designation')->index();
        });
    }

    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropIndex(['meeting_type']);
            $table->dropColumn('meeting_type');
        });
    }
};