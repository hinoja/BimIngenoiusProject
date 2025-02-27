<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraph(4),
            'slug' => $this->faker->slug(),
             'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => random_int(1, 10),
        ];
    }
}
