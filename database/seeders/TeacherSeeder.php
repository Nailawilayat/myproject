<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Warisha Sahar', 'email' => 'warisha@example.com'],
            ['name' => 'Muhammad Mustafa', 'email' => 'mustafa@example.com'],
            ['name' => 'Urwa Maryam', 'email' => 'maryam@example.com'],
            ['name' => 'Basira Sahar', 'email' => 'sahar@example.com'],
            ['name' => 'Muhammad Haris', 'email' => 'haris@example.com'],
            ['name' => 'Nazira Maryam', 'email' => 'nazira@example.com'],
        ];

        foreach ($teachers as $t) {
            DB::table('teachers')->insert([
                'name' => $t['name'],
                'email' => $t['email'],
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}