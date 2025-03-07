<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('front.projects.index');
    }

    // public function show(Project $project)
    // {
    //     return view('front.projects.show', [
    //         'project' => $project,
    //     ]);
    // }
}
