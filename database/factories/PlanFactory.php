<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $frTitle = ucfirst(fake()->unique()->words(2, true)) . ' ' . uniqid();
        $enTitle = ucfirst(fake()->unique()->words(2, true)) . ' ' . uniqid();
        

        return [
            'fr_title' => $frTitle,
            'en_title' => $enTitle,
            'slug' => Str::slug($enTitle),
            'fr_description' => fake()->paragraph(20),
            'en_description' => fake()->paragraph(20),
            'user_id' => \App\Models\User::factory(),
            'image2D' => 'plans/2d/default-plan.jpg', // Add default image
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
