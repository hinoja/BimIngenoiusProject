<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Quote;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use App\Models\{Category, Tag, Project, News, User};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
        ]);

        User::factory()
            ->count(10)
            ->hasPlans(3)
            ->hasNews(3)
            ->create();

        $tags = Tag::factory(50)->create();

        $news = News::query()
                    ->get()
                    ->each(function($item) use ($tags) {
                        $item->tags()->attach($tags->random(rand(2, 3)));
                    }
                );

        $categories = Category::query()->get()->take(15);

        Project::factory()
            ->count(25)
            ->create()
            ->each(function ($project) use ($categories, $tags) {
                $project->category()->associate($categories->random())->save();

                $project->tags()->attach($tags->random(rand(1, 5))->pluck('id')->toArray());
            });

        Quote::factory(50)->create();
    }
}