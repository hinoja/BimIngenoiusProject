<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
        ]);
    }
    public function show(Project $project)
    {
        return view('admin.projects.show', [
            'project' => $project,
        ]);
    }
}
