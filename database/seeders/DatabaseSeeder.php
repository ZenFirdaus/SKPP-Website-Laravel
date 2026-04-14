<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff Admin',
                'password' => bcrypt('staff123'),
                'role' => 'staff',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kepala@example.com'],
            [
                'name' => 'Kepala Staff',
                'password' => bcrypt('kepala123'),
                'role' => 'kepala',
            ]
        );

        Pengajuan::factory()->count(5)->create([
            'user_id' => 1,
        ]);
    }
}
