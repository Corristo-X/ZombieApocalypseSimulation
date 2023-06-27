<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Human>
 */
class HumanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'health_status'=>$this->faker->randomFloat(1,0,1),
            'physical_fitness'=>$this->faker->numberBetween(0,10),
            'resource_consumption'=>$this->faker->numberBetween(0,10),
            'action_decision'=>$this->faker->randomElement(['fight','escape']),
        ];
    }
}
