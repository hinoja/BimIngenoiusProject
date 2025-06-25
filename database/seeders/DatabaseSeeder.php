<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Quote;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;
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

        // Create admin user
        User::factory()->create([
            'role_id' => 1,
            'name' => 'Admin BIM ingenious BTP',
            'email' => 'admin@bim.com',
            'is_active' => true,
            'password' => Hash::make('password')
        ]);

        // Create tags with unique names
        $tags = collect();
        for ($i = 0; $i < 50; $i++) {
            $frName = fake()->unique()->words(2, true);
            $enName = fake()->unique()->words(2, true);

            $tags->push(Tag::factory()->create([
                'fr_name' => ucfirst($frName),
                'en_name' => ucfirst($enName),
                'slug' => Str::slug($enName)
            ]));
        }

        // Attach tags to news
        News::all()->each(function ($news) use ($tags) {
            $news->tags()->attach(
                $tags->random(rand(2, 3))->pluck('id')->toArray()
            );
        });

        // Create and associate projects
        $categories = Category::take(15)->get();

        if ($categories->isNotEmpty() && $tags->isNotEmpty()) {
            Project::factory()
                ->count(25)
                ->create()
                ->each(function ($project) use ($categories, $tags) {
                    $project->category()->associate($categories->random())->save();
                    $project->tags()->attach(
                        $tags->random(rand(1, 5))->pluck('id')->toArray()
                    );
                });
        }

        Quote::factory(50)->create();
    }
}
