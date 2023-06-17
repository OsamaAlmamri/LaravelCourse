<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model=Category::class;
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            "description"=>fake()->address(),
            "type"=>fake()->randomElement(['Old', 'New']),
            "status"=>fake()->randomElement([0,1]),
        ];
    }


}
