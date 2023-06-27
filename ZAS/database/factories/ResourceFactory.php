<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return[
            'food'=>$this->faker->numberBetween(0,25),//adds a random value from 0-25
            'water'=>$this->faker->numberBetween(0,25),//adds a random value from 0-25
            'medical_supplies'=>$this->faker->numberBetween(0,25),//adds a random value from 0-25
            'weapon'=>$this->faker->numberBetween(0,25),//adds a random value from 0-25
        ];
    }
}
