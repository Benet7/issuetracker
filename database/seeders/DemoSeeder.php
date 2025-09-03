<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;
use App\Models\Project;
use App\Models\Issue;
use App\Models\Comment;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory()->count(8)->create();

        Project::factory()
            ->count(3)
            ->has(
                Issue::factory()
                    ->count(12)
                    ->has(Comment::factory()->count(3))
            )
            ->create();

        // Randomly attach tags to issues
        Issue::all()->each(function($issue) use ($tags){
            $issue->tags()->attach($tags->random(rand(0,3))->pluck('id')->all());
        });
    }
}
