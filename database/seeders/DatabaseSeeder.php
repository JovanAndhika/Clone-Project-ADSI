<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JenisBarang;
use App\Models\Wirausaha;
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

        $admin = [
            [
                'name' => 'Fellix',
                'email' => 'c14220039@john.petra.ac.id'
            ], 
            [
                'name' => 'Marvel',
                'email' => 'c14220223@john.petra.ac.id'
            ],
            [
                'name' => 'Jovan',
                'email' => 'c14220013@john.petra.ac.id'
            ],
            [
                'name' => 'Nicholas',
                'email' => 'c14220142@john.petra.ac.id'
            ]
        ];
        foreach ($admin as $wirausaha) {
            $wirausaha ['password'] = bcrypt('password');
            \App\Models\Wirausaha::create($wirausaha);
        }
        \App\Models\Wirausaha::factory()->create();

        //dummy jenis barang
        $categories = [
            ['nama' => 'Electronics'],
            ['nama' => 'Books'],
            ['nama' => 'Clothing'],
            ['nama' => 'Home & Kitchen'],
            ['nama' => 'Sports'],
            ['nama' => 'Toys & Games'],
            ['nama' => 'Beauty & Personal Care'],
            ['nama' => 'Automotive'],
            ['nama' => 'Health & Household'],
            ['nama' => 'Grocery'],
        ];

        foreach ($categories as $category) {
            \App\Models\JenisBarang::create($category);
        }

        
        // dummy barang
        \App\Models\Barang::factory()->count(50)->create();

    }
}
