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
        $frTitle = ucfirst(fake()->word()) . ' ' . fake()->word(); 
        $enTitle = ucfirst(fake()->word()) . ' ' . fake()->word();
        
        return [
            'fr_title' => $frTitle,
            'en_title' => $enTitle,
            'slug' => Str::slug($enTitle),
            'fr_description' => fake()->paragraph(20),
            'en_description' => fake()->paragraph(20),
            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}