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
        // dummy user
        \App\Models\Customer::factory()->create();
        \App\Models\Driver::factory()->create();
        \App\Models\Wirausaha::factory()->create();

        // dummy barang
        \App\Models\Barang::factory()->count(10)->create();
    }
}
