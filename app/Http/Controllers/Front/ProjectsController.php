<?php

namespace App\Http\Controllers\Front;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index()
    {
        // dd(Project::find(27)->images->first()->name);
        $projects = Project::query()
                            ->latest()
                            ->with('category');

        $categories = $projects->get()->pluck('category')->unique();

        $rand_view = fake()->randomElement(['', '-2']);

        return view('front.projects.index', [
            'projects' => $projects->with('images', 'category:id,slug,fr_name,en_name', 'tags:name')->paginate(9),
            'categories' => $categories->take(6),
        ]);
    }

    public function show(Project $project)
    {
        $rand_view = fake()->randomElement(['', '-2']);

        return view('front.projects.show-2', [
            'project' => $project,
        ]);
    }
}
