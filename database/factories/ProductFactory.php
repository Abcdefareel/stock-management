<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->words(2, true),
            'id_category' => \App\Models\Category::inRandomOrder()->first()->id_category,
            'id_supplier' => \App\Models\Supplier::inRandomOrder()->first()->id_supplier,
        ];
    }
}
