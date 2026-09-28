<?php

namespace Database\Factories;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengajuan>
 */
class PengajuanFactory extends Factory
{
    protected $model = Pengajuan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_perusahaan' => fake()->company(),
            'alamat' => fake()->address(),
            'npwp' => fake()->numerify('##.###.###.#-###.###'),
            'keperluan' => fake()->sentence(),
            'status' => 'menunggu',
            'file_slip_gaji' => null,
            'file_sk' => null,
            'file_skpp' => null,
            'status_pencatatan' => 'belum_dicatat',
            'status_pengecekan' => 'menunggu',
            'status_draft' => 'belum',
            'status_arsip' => 'belum',
        ];
    }

    public function dicatat(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diproses',
            'status_pencatatan' => 'selesai_dicatat',
        ]);
    }

    public function disetujui(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'disetujui',
            'status_pencatatan' => 'selesai_dicatat',
            'status_pengecekan' => 'disetujui',
        ]);
    }

    public function ditolak(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
            'status_pencatatan' => 'selesai_dicatat',
            'status_pengecekan' => 'ditolak',
        ]);
    }

    public function draftUploaded(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'diproses',
            'status_pencatatan' => 'selesai_dicatat',
            'status_pengecekan' => 'disetujui',
            'status_draft' => 'sudah_diupload',
        ]);
    }

    public function diarsipkan(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'selesai',
            'status_pencatatan' => 'selesai_dicatat',
            'status_pengecekan' => 'disetujui',
            'status_draft' => 'sudah_diupload',
            'status_arsip' => 'diarsipkan',
        ]);
    }
}
