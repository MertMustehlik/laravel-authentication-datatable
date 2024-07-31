<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => 123123
        ]);
        \App\Models\User::create([
            'name' => 'Test User - 2',
            'email' => 'admin2@admin.com',
            'password' => 123123
        ]);

        \App\Models\User::factory(500)->create();
    }
}
