<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Project::class;
    
    public function definition(): array
{
    return [
        'name' => fake()->unique()->company(),
        'description' => fake()->sentence(10),
        'start_date' => now()->subDays(rand(1,60))->toDateString(),
        'deadline' => now()->addDays(rand(10,90))->toDateString(),
    ];
}
}
