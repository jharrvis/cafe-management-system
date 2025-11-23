<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class StudentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin Kantin',
            'email' => 'admin@kantin.sch.id',
            'nisn' => null,
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create student users
        $students = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@kantin.sch.id',
                'nisn' => '1234567890',
                'password' => bcrypt('password'),
                'role' => 'student',
                'is_active' => true,
            ],
            [
                'name' => 'Ani Lestari',
                'email' => 'ani@kantin.sch.id',
                'nisn' => '0987654321',
                'password' => bcrypt('password'),
                'role' => 'student',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@kantin.sch.id',
                'nisn' => '1122334455',
                'password' => bcrypt('password'),
                'role' => 'student',
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@kantin.sch.id',
                'nisn' => '5544332211',
                'password' => bcrypt('password'),
                'role' => 'student',
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi@kantin.sch.id',
                'nisn' => '6677889900',
                'password' => bcrypt('password'),
                'role' => 'student',
                'is_active' => true,
            ]
        ];

        foreach ($students as $student) {
            User::create($student);
        }
    }
}