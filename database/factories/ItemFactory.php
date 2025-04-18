<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name'=>fake()->sentence(4),
            'price'=>fake()->randomFloat(2, 1, 1000),
        ];
    }
}
