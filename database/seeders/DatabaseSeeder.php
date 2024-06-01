<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'PhuongMT',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('phuong@123'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'Mai Phượng',
            'email' => 'phuong@gmail.com',
            'password' => Hash::make('phuong@123'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'Học sinh 1',
            'email' => 'hs1@gmail.com',
            'password' => Hash::make('phuong@123'),
            'role' => 3,
        ]);

        User::create([
            'name' => 'Học sinh 2',
            'email' => 'hs2@gmail.com',
            'password' => Hash::make('phuong@123'),
            'role' => 3,
        ]);
    }
}
