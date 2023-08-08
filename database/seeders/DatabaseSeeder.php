<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\User::create([
            'username' => 'admin001',
            'password' => Hash::make('12345678'),
            'name'     => 'Admin',
            'role'     => 'admin',
        ]);

        \App\Models\User::create([
            'username' => 'sdm001',
            'password' => Hash::make('12345678'),
            'name'     => 'Admin SDM',
            'role'     => 'sdm',
        ]);

        \App\Models\User::create([
            'username' => 'pegawai001',
            'password' => Hash::make('12345678'),
            'name'     => 'John Doe',
            'role'     => 'pegawai',
        ]);
    }
}
