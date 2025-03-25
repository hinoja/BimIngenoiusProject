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
        $projects = Project::query()
                            ->latest()
                            ->with('category');
        
        $categories = $projects->get()->pluck('category')->unique();
        
        $rand_view = fake()->randomElement(['', '-2']);
        
        return view('front.projects.index'. $rand_view , [
            'projects' => $projects->with('images:id,name', 'category:id,slug,name', 'tags:name')->paginate(9),
            'categories' => $categories->take(6),
        ]);
    }

    public function show(Project $project)
    {
        $rand_view = fake()->randomElement(['', '-2']);

        return view('front.projects.show' . $rand_view, [
            'project' => $project,
        ]);
    }
}
