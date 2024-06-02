<?php

namespace Database\Factories;

use App\Models\JenisBarang;
use App\Models\Wirausaha;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->word(),
            'harga' => fake()->randomNumber(3) * 1000,
            'stock' => fake()->randomNumber(2),
            'wirausaha_id' => Wirausaha::inRandomOrder()->first()->id ?? Wirausaha::factory()->create()->id,
            'jenis_barang_id' =>  JenisBarang::inRandomOrder()->first()->id ?? JenisBarang::factory()->create()->id,
            'foto' => 'https://source.unsplash.com/random/' . fake()->numberBetween(1, 100),
            'detail' => fake()->paragraph(),
        ];
    }
}
