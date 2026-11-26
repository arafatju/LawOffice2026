<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE meetings MODIFY user_id VARCHAR(50) NOT NULL');
    }

    public function down(): void
    {
        // only works while every user_id is numeric
        DB::statement('ALTER TABLE meetings MODIFY user_id BIGINT UNSIGNED NOT NULL');
    }
};