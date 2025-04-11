<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // First, truncate the table to avoid duplicates
        Category::truncate();

        $categories = [
            // ...existing categories array...
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category[1]); // Use English name for slug
            $count = 1;

            // Check if slug exists and generate a unique one
            while (Category::where('slug', $slug)->exists()) {
                $slug = Str::slug($category[1]) . '-' . $count;
                $count++;
            }

            Category::create([
                'fr_name' => $category[0],
                'en_name' => $category[1],
                'slug' => $slug,
                'description' => $faker->paragraph(3),
                'image' => $faker->optional(0.7)->imageUrl(640, 480, 'construction', true)
            ]);
        }

        // Generate random categories with unique names
        $usedNames = Category::pluck('en_name')->toArray();

        for ($i = 0; $i < 10; $i++) {
            do {
                $name = ucfirst($faker->unique()->words($faker->numberBetween(1, 3), true));
            } while (in_array($name, $usedNames));

            $usedNames[] = $name;
            $slug = Str::slug($name);

            // Ensure unique slug
            $count = 1;
            while (Category::where('slug', $slug)->exists()) {
                $slug = Str::slug($name) . '-' . $count;
                $count++;
            }

            Category::create([
                'fr_name' => 'Catégorie ' . $name,
                'en_name' => 'Category ' . $name,
                'slug' => $slug,
                'description' => $faker->paragraph(2),
                'image' => $faker->optional(0.5)->imageUrl(640, 480, 'abstract', true)
            ]);
        }
    }
}
