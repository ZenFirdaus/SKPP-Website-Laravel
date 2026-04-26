<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('arsip', function (Blueprint $table) {
        //     // $table->timestamp('tanggal_selesai')->nullable()->after('dikirim_ke_mitra');
        //     $table->timestamp('tanggal_arsip')->nullable()->after('tanggal_selesai');
        //     $table->foreignId('diarsipkan_oleh')->nullable()->after('pengajuan_id')
        //         ->constrained('users')->onDelete('cascade');
        // });
    }

    public function down(): void
    {
        // Schema::table('arsip', function (Blueprint $table) {
        //     $table->dropColumn(['tanggal_arsip', 'diarsipkan_oleh']);
        // });
    }
};
