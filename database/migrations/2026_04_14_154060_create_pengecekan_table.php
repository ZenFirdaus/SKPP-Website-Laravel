<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengecekan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->onDelete('cascade');
            $table->enum('slip_gaji', ['lengkap', 'tidak'])->nullable();
            $table->enum('sk', ['lengkap', 'tidak'])->nullable();
            $table->enum('surat_pengantar', ['lengkap', 'tidak'])->nullable();
            $table->enum('keputusan', ['setuju', 'tolak'])->nullable();
            $table->text('catatan_pengecekan')->nullable();
            $table->foreignId('dicek_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('pengajuan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan', 'status_pengecekan')) {
                $table->enum('status_pengecekan', ['menunggu', 'disetujui', 'ditolak'])
                    ->default('menunggu')
                    ->after('status_pencatatan');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengecekan');
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn('status_pengecekan');
        });
    }
};