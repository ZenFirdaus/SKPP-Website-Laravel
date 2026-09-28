<?php

namespace Database\Factories;

use App\Models\DraftSkpp;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DraftSkppFactory extends Factory
{
    protected $model = DraftSkpp::class;

    public function definition(): array
    {
        return [
            'pengajuan_id' => Pengajuan::factory(),
            'diupload_oleh' => User::factory()->kepala(),
            'file_skpp' => 'draft_skpp/sample.pdf',
            'tanggal_upload' => now(),
        ];
    }
}
