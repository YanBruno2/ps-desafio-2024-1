<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => $this->faker->name,
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 2, 100),
            'image' => $this->faker->imageUrl(),
            'categoria_id' => fn () => Product::factory()->create()->id,

        ];
    }
}
