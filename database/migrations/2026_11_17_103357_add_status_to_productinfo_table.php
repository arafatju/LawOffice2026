<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('productinfo', 'status')) {
            Schema::table('productinfo', function (Blueprint $table) {
                $table->string('status', 20)->default('ok11')->index();
            });
        }

        // Make sure every existing row is ok11 (also covers NULL or empty values)
        DB::table('productinfo')
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'ok11');
            })
            ->update(['status' => 'ok11']);
    }

    public function down(): void
    {
        if (Schema::hasColumn('productinfo', 'status')) {
            Schema::table('productinfo', function (Blueprint $table) {
                $table->dropIndex(['status']);
                $table->dropColumn('status');
            });
        }
    }
};