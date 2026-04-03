<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permohonan;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\User::factory()->create([
        'email' => 'user@test.com',
        'password' => bcrypt('password'),
    ]);

    Permohonan::factory()->count(5)->create([
        'user_id' => 1,
    ]);
    }
    
}
