<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::query()->get()->pluck('id')->toArray();

        return [
            'customer_id' => Customer::factory(),
            'category_id' => fake()->randomElement($categories),
            'title' => fake()->sentence(4),
            'details' => fake()->paragraph(5),
            'budget' => fake()->randomFloat(2, 1000, 50000),
            'currency' => fake()->currencyCode(),
            // 'project_department' => fake()->state(),
            'project_city' => fake()->city(),
            'file' => fake()->optional()->filePath(),
        ];
    }
}
