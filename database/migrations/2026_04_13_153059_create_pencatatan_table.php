<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencatatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuans_id')->constrained('pengajuans')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nip');
            $table->enum('status_dokumen', ['valid', 'tidak_valid'])->default('valid');
            $table->text('catatan')->nullable();
            $table->foreignId('dicatat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tambah kolom status ke tabel pengajuans jika belum ada
        Schema::table('pengajuans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuans', 'status_pencatatan')) {
                $table->enum('status_pencatatan', ['belum_dicatat', 'selesai_dicatat'])
                    ->default('belum_dicatat')
                    ->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencatatan');
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn('status_pencatatan');
        });
    }
};