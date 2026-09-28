<?php

namespace Database\Factories;

use App\Models\Arsip;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArsipFactory extends Factory
{
    protected $model = Arsip::class;

    public function definition(): array
    {
        return [
            'pengajuan_id' => Pengajuan::factory(),
            'diarsipkan_oleh' => User::factory()->staff(),
            'dikirim_ke_mitra' => true,
            'tanggal_selesai' => now(),
            'tanggal_arsip' => now(),
        ];
    }
}
