<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Project;
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
        $categories = Category::all()->pluck('id')->toArray();

        $plans = Plan::pluck('id')->toArray();
        $projects = Project::pluck('id')->toArray();

        $quotableType = fake()->randomElement([
            Plan::class,
            Project::class,
        ]);

        if ($quotableType === Plan::class && !empty($plans)) {
            $quotableId = fake()->randomElement($plans);
        } elseif ($quotableType === Project::class && !empty($projects)) {
            $quotableId = fake()->randomElement($projects);
        } else {
            $quotableType = null;
            $quotableId = null;
        }

        return [
            'customer_id'    => Customer::factory(),
            'category_id'    => fake()->randomElement($categories),
            'title'          => fake()->sentence(4),
            'details'        => fake()->paragraph(5),
            'budget'         => fake()->randomFloat(2, 1000, 50000),
            'currency'       => fake()->currencyCode(),
            'project_city'   => fake()->city(),
            'file'           => fake()->optional()->filePath(),
            'quotable_id'    => $quotableId,
            'quotable_type'  => $quotableType,
        ];
    }
}
