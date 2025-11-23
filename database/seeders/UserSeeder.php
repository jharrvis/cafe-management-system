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
            ],
            [
                'name' => 'Ani Lestari',
                'email' => 'ani@kantin.sch.id',
                'username' => 'ani',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@kantin.sch.id',
                'username' => 'siti',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@kantin.sch.id',
                'username' => 'ahmad',
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi@kantin.sch.id',
                'username' => 'dewi',
            ],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'username' => $student['username'],
                'password' => Hash::make('password'),
                'role' => 'student',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }
    }
}
