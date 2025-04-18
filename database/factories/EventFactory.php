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
            'dresscode'=>fake()->word(),
            'datetime' => fake()->dateTimeBetween('now', '+2 years'),
        ];
    }
}
