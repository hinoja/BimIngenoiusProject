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

        return view('front.projects.index', [
            'projects' => $projects->with('images')->paginate(9),
            'categories' => $categories->take(6),
        ]);
    }

    public function show(Project $project)
    {
        return view('front.projects.show', [
            'project' => $project,
        ]);
    }
}
