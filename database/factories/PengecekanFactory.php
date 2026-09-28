<?php

namespace Database\Factories;

use App\Models\Pengajuan;
use App\Models\Pengecekan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengecekanFactory extends Factory
{
    protected $model = Pengecekan::class;

    public function definition(): array
    {
        return [
            'pengajuan_id' => Pengajuan::factory(),
            'slip_gaji' => 'lengkap',
            'sk' => 'lengkap',
            'surat_pengantar' => 'lengkap',
            'keputusan' => 'setuju',
            'catatan_pengecekan' => fake()->sentence(),
            'dicek_oleh' => User::factory()->kepala(),
        ];
    }
}
