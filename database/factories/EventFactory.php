<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name'=>fake()->sentence(4),
            'description'=>fake()->paragraph(2),
            'dresscode'=>fake()->randomElement(['Full suit', 'Semi-formal', 'Casual', 'Traditional', 'Theme costume']),
            'datetime' => fake()->dateTimeBetween('now', '+2 years'),
            'user_id' => "1"
        ];
    }
}
