<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Guru
        User::firstOrCreate(
            ['email' => 'guru@sekolah.com'],
            [
                'name' => 'Guru Matematika',
                'password' => Hash::make('password'),
                'role' => 'guru'
            ]
        );

        // Siswa
        User::firstOrCreate(
            ['email' => 'siswa@sekolah.com'],
            [
                'name' => 'Siswa Contoh',
                'password' => Hash::make('password'),
                'role' => 'siswa'
            ]
        );
    }
}