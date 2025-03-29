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
        $frTitle = fake('fr_FR')->unique()->jobTitle();
        $enTitle = fake()->unique()->jobTitle();

        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = fake()->dateTimeBetween($startDate, '+1 year');

        return [
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
            'company' => fake()->company,
            'fr_title' => $frTitle,
            'en_title' => $enTitle,
            'slug' => Str::slug($enTitle),
            'fr_description' => fake('fr_FR')->paragraph(25),
            'en_description' => fake()->paragraph(25),
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