<?php

namespace Database\Factories;

use App\Models\Pencatatan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PencatatanFactory extends Factory
{
    protected $model = Pencatatan::class;

    public function definition(): array
    {
        return [
            'pengajuan_id' => Pengajuan::factory(),
            'nama_lengkap' => fake()->name(),
            'nip' => fake()->numerify('199#########00#'),
            'status_dokumen' => 'valid',
            'catatan' => fake()->sentence(),
            'dicatat_oleh' => User::factory()->staff(),
        ];
    }
}
