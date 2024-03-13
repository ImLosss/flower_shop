<?php

namespace Database\Factories;

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
            'category_id' => mt_rand(1, 3),
            'name' => $this->faker->words(mt_rand(1, 2), true),
            'src_img' => 'product/image.png',
            'description' => $this->faker->sentence(mt_rand(1,15)),
            'rate' => mt_rand(3,5),
            'price' => $this->faker->randomNumber(mt_rand(3, 6), true),
            'disc' => $this->faker->randomNumber(mt_rand(3, 5), true),
        ];
    }
}
