<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::firstOrCreate([
            'name' => 'Game Developer User',
            'email' => 'Game-Developer@example.com',
            'password' => Hash::make('password'),
            'role' => 'Game-Developer',
        ]);
        User::firstOrCreate([
            'name' => 'Tester User',
            'email' => 'tester@example.com',
            'password' => Hash::make('password'),
            'role' => 'tester',
        ]);
        User::firstOrCreate([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
