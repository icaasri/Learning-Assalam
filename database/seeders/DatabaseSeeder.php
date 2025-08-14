<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course; // <-- Tambahkan ini
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- Tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus User::factory() yang lama jika ada

        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@assalaam.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 2. Buat Contoh Akun Guru
        User::create([
            'name' => 'Guru Hebat',
            'email' => 'guru@assalaam.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'email_verified_at' => now(),
        ]);

        // 3. Buat 10 Akun Siswa menggunakan Factory
        User::factory(10)->create([
            'role' => 'siswa',
        ]);

        // 4. Buat Beberapa Mata Pelajaran
        Course::create([
            'name' => 'Matematika',
            'description' => 'Mata pelajaran yang mempelajari tentang logika, bentuk, susunan, dan besaran.'
        ]);

        Course::create([
            'name' => 'Bahasa Indonesia',
            'description' => 'Mata pelajaran yang mempelajari tentang sastra dan kebahasaan Indonesia.'
        ]);

        Course::create([
            'name' => 'Ilmu Pengetahuan Alam',
            'description' => 'Mata pelajaran yang mempelajari tentang alam dan fenomena di sekitarnya.'
        ]);
    }
}