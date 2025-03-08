<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Residential Construction',
            'Commercial Construction',
            'Industrial Construction',
            'Infrastructure Construction',
            'Renovation',
            'Interior Design',
            'Landscape Design',
            'Project Management',
            'Sustainable Building',
            'Urban Planning',
            'Architecture',
            'Engineering',
            'Consulting',
            'Real Estate',
            'Property Management',
            'Facility Management',
            'Construction Equipment',
            'Building Materials',
            'Green Building',
            'Energy Efficiency',
            'Smart Buildings',
            'Modular Construction',
            'Prefabrication',
            'Construction Technology',
            'Construction Safety',
        ];

        foreach ($categories as $category) {
            Category::query()
                    ->create(['name' => $category]);
        }
    }
}