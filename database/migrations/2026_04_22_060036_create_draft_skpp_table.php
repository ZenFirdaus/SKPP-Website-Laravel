<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('draft_skpp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->foreignId('diupload_oleh')->constrained('users')->onDelete('cascade');
            $table->string('file_skpp');
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();
        });

        // Tambah kolom status_draft ke pengajuans
        Schema::table('pengajuans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuans', 'status_draft')) {
                $table->enum('status_draft', ['belum', 'sudah_diupload'])
                    ->default('belum')
                    ->after('status_arsip');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('draft_skpp');
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn('status_draft');
        });
    }
};