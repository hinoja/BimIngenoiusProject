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
        // dd($projects->get(), $categories);

        return view('front.projects.index', [
            'projects' => $projects->with('images')->paginate(9),
            'categories' => $categories->take(5),
        ]);
    }

    public function show(Project $project)
    {
        return view('front.projects.show', [
            'project' => $project,
        ]);
    }
}
