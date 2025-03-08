<?php

namespace Database\Factories;

use App\Enums\SizeEnums;
use App\Models\Category;
use App\Enums\StatusEnums;
use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = fake()->dateTimeBetween($startDate, '+1 year');

        return [
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
            'company' => fake()->company,
            'title' => fake()->unique()->jobTitle(),
            'description' => fake()->paragraph,
            'country' => fake()->country,
            'city' => fake()->city,
            'address' => fake()->address,
            'status' => fake()->randomElement(StatusEnums::cases())->value,
            'size' => fake()->randomElement(SizeEnums::cases())->value,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
