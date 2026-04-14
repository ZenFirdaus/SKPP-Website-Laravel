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
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->enum('status_pencatatan', ['belum_dicatat', 'selesai_dicatat'])
                ->default('belum_dicatat')->after('status');
            $table->enum('status_pengecekan', ['menunggu', 'disetujui', 'ditolak'])
                ->default('menunggu')->after('status_pencatatan');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn(['status_pencatatan', 'status_pengecekan']);
        });
    }
};
