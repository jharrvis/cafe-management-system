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
            'nisn' => null,
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
                'nisn' => '1234567890',
            ],
            [
                'name' => 'Ani Lestari',
                'email' => 'ani@kantin.sch.id',
                'nisn' => '0987654321',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@kantin.sch.id',
                'nisn' => '1122334455',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@kantin.sch.id',
                'nisn' => '5544332211',
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi@kantin.sch.id',
                'nisn' => '6677889900',
            ],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'nisn' => $student['nisn'],
                'password' => Hash::make('password'),
                'role' => 'student',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
