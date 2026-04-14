<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Staff
        User::create([
            'name'     => 'Staff Admin',
            'email'    => 'staff@example.com',
            'password' => Hash::make('staff123'),
            'role'     => 'staff',
        ]);

        // Kepala
        User::create([
            'name'     => 'Kepala Staff',
            'email'    => 'kepala@example.com',
            'password' => Hash::make('kepala123'),
            'role'     => 'kepala',
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