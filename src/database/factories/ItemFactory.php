<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'condition'=> $this->faker->numberBetween(1, 4),
            'price' => $this->faker->numberBetween(100, 10000),
            'image' => 'sample.jpg',
            'sold' => false,
        ];
    }
}
