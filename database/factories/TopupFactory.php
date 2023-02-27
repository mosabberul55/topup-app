<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TopupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 500),
            'amount' => $this->faker->numberBetween(100, 10000),
            'created_at' => $this->faker->dateTimeBetween('-3 days', 'now'),
            'updated_at' => now()
        ];
    }
}
