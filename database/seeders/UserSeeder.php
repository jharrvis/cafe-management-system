<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@kantin.sch.id',
            'username' => 'admin',
            'alamat' => 'Jl. Admin No. 1, Kota Cafe',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Student Accounts
        $students = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@kantin.sch.id',
                'username' => 'budi',
                'alamat' => 'Jl. Merdeka No. 10, Kota A',
            ],
            [
                'name' => 'Ani Lestari',
                'email' => 'ani@kantin.sch.id',
                'username' => 'ani',
                'alamat' => 'Jl. Pahlawan No. 15, Kota B',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@kantin.sch.id',
                'username' => 'siti',
                'alamat' => 'Jl. Sudirman No. 20, Kota C',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@kantin.sch.id',
                'username' => 'ahmad',
                'alamat' => 'Jl. Gatot Subroto No. 5, Kota D',
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi@kantin.sch.id',
                'username' => 'dewi',
                'alamat' => 'Jl. Diponegoro No. 8, Kota E',
            ],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'username' => $student['username'],
                'alamat' => $student['alamat'],
                'password' => Hash::make('password'),
                'role' => 'student',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
