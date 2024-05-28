<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // dummy user
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => '0',
        ]);

        // dummy driver
        User::factory()->create([
            'name' => 'Driver',
            'email' => 'driver@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => '1',
        ]);

        // dummy wirausaha
        User::factory()->create([
            'name' => 'Wirausaha',
            'email' => 'wirausaha@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => '2',
        ]);

        // dummy barang
        \App\Models\Barang::factory()->count(10)->create();
    }
}
