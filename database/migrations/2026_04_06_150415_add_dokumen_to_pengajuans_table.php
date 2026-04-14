<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->string('file_slip_gaji')->nullable()->after('keperluan');
            $table->string('file_sk')->nullable()->after('file_slip_gaji');
            $table->string('file_skpp')->nullable()->after('file_sk');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['file_slip_gaji', 'file_sk', 'file_skpp']);
        });
    }
};