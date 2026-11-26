<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1) section_id (skipped if a failed earlier run already added it)
        if (!Schema::hasColumn('meetings', 'section_id')) {
            Schema::table('meetings', function (Blueprint $table) {
                $table->foreignId('section_id')
                      ->nullable()
                      ->after('directorate_id')
                      ->constrained('institutes');
            });
        }

        // 2) category must accept: ministry | autonomous | ngo | other.
        //    Only needed if the column is an ENUM; a string column already accepts them.
        //    Plain SQL, so doctrine/dbal is not required.
        $col = DB::selectOne(
            "SELECT DATA_TYPE AS data_type
               FROM information_schema.COLUMNS
              WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'meetings'
                AND COLUMN_NAME = 'category'"
        );

        if ($col && strtolower($col->data_type) === 'enum') {
            DB::statement("ALTER TABLE meetings MODIFY category VARCHAR(20) NOT NULL");
        }
    }

    public function down()
    {
        if (Schema::hasColumn('meetings', 'section_id')) {
            Schema::table('meetings', function (Blueprint $table) {
                $table->dropForeign(['section_id']);
                $table->dropColumn('section_id');
            });
        }
    }
};