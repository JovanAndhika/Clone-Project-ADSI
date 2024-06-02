<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tugas;
use App\Models\NotaBeli;
use App\Models\NotaJual;
use App\Models\Wirausaha;
use App\Models\JenisBarang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            $wirausaha['password'] = bcrypt('password');
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


        // Dummy Nota Jual
        NotaJual::create([
            'nama' => 'barang legendaris',
            'foto' => 'exclusive_path',
            'status' => 1,
            'alamat' => 'tidak rahasia',
            'harga' => 12000,
            'customer_id' => 1,
            'wirausaha_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NotaJual::create([
            'nama' => 'barang legendaris dua',
            'foto' => 'exclusive_path',
            'status' => 1,
            'alamat' => 'rahasia',
            'harga' => 12000,
            'customer_id' => 1,
            'wirausaha_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Dummy nota beli
        NotaBeli::create([
            'status' => 0,
            'alamat_customer' => 'ssssss',
            'komplain' => 'Tidak ada complain',
            'customer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        NotaBeli::create([
            'status' => 0,
            'alamat_customer' => 'ssssss',
            'komplain' => 'Tidak ada complain',
            'customer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Dummy tabel barang_nota_beli
        DB::table('barang_nota_beli')->insert([
            ['barang_id' => 24, 'nota_beli_id' => 1, 'jumlah' => 6],
            ['barang_id' => 20, 'nota_beli_id' => 2, 'jumlah' => 12],
        ]);

        // Dummy tabel nota_juals
        DB::table('nota_juals')->insert([
            ['nama'=> 'barang legendaris', 'foto' => 'exclusive_path', 'status' => 1, 'alamat' => 'tidak rahasia', 'harga' => 12000, 'customer_id' => 1, 'wirausaha_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nama'=> 'barang legendaris dua', 'foto' => 'exclusive_path', 'status' => 1, 'alamat' => 'rahasia', 'harga' => 14000, 'customer_id' => 1, 'wirausaha_id' => 2, 'created_at' => now(), 'updated_at' => now()]
        ]);

        // Dummy Tugas
        Tugas::create([
            'jenis_tugas' => 'Pengantaran',
            'nota_beli_id' => 1,
            'nama_penerima' => 'Josh Due',
            'status' => 'belum_diambil',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tugas::create([
            'jenis_tugas' => 'Pengantaran',
            'nota_beli_id' => 2,
            'nama_penerima' => 'John Doe',
            'status' => 'berlangsung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tugas::create([
            'jenis_tugas' => 'Penjemputan',
            'nota_jual_id' => 1,
            'nama_penerima' => 'Josh Row',
            'status' => 'belum_diambil',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tugas::create([
            'jenis_tugas' => 'Penjemputan',
            'nota_jual_id' => 2,
            'nama_penerima' => 'John Column',
            'status' => 'berlangsung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
