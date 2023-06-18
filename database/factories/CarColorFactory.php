<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarColor>
 */
class CarColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_id'=>fake()->randomElement([1,2,3]),
            'name'=>fake()->country(),
            'color_id'=>fake()->randomElement([1,2,3,4,5,6,7,8,9,10])

        ];
    }
}
