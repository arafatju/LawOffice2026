<?php

 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE loginfo MODIFY mobile VARCHAR(20) NULL');
    }

    public function down(): void
    {
        DB::statement("UPDATE loginfo SET mobile = '' WHERE mobile IS NULL");
        DB::statement('ALTER TABLE loginfo MODIFY mobile VARCHAR(20) NOT NULL');
    }
};
