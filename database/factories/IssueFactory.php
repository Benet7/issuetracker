<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\Project;   
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    protected $model = Issue::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['open','in_progress','closed']),
            'priority' => $this->faker->randomElement(['low','medium','high']),
            'due_date' => rand(0,1) ? now()->addDays(rand(1,60))->toDateString() : null,
        ];
    }
}
