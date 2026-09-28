<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Staff
        User::create([
            'name' => 'Staff Admin',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
        ]);

        // Kepala
        User::create([
            'name' => 'Kepala Staff',
            'email' => 'kepala@example.com',
            'password' => Hash::make('kepala123'),
            'role' => 'kepala',
        ]);

        // // Mitra
        // User::create([
        //     'name'     => 'Mitra Satu',
        //     'email'    => 'mitra@example.com',
        //     'password' => Hash::make('mitra123'),
        //     'role'     => 'mitra',
        // ]);
    }
}
