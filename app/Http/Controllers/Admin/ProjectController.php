<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;
use App\Enums\StatusEnums;
use App\Enums\SizeEnums;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['category', 'tags', 'images'])->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $statuses = StatusEnums::cases();
        $sizes = SizeEnums::cases();
        return view('admin.projects.create', compact('categories', 'tags', 'statuses', 'sizes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fr_title' => 'required|string|min:2|unique:projects,fr_title',
            'en_title' => 'required|string|min:2|unique:projects,en_title',
            'fr_description' => 'required|string|min:10',
            'en_description' => 'required|string|min:10',
            'company' => 'required|string|min:2',
            'country' => 'required|string|min:2',
            'city' => 'required|string|min:2',
            'address' => 'required|string|min:5',
            'status' => 'required|in:' . implode(',', array_map(fn($status) => $status->value, StatusEnums::cases())),
            'size' => 'required|in:' . implode(',', array_map(fn($size) => $size->value, SizeEnums::cases())),
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'required|exists:categories,id',
            'plan_id' => 'nullable|exists:plans,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $project = Project::create([
            'fr_title' => $validated['fr_title'],
            'en_title' => $validated['en_title'],
            'slug' => Str::slug($validated['en_title']),
            'fr_description' => $validated['fr_description'],
            'en_description' => $validated['en_description'],
            'company' => $validated['company'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'status' => $validated['status'],
            'size' => $validated['size'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'category_id' => $validated['category_id'],
            'plan_id' => $validated['status'] === StatusEnums::Idea->value ? $validated['plan_id'] : null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = 'project_' . Str::slug($project->fr_title) . '_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('projects/images', $filename, 'public');
                $project->images()->create([
                    'name' => $path,
                    'original_name' => $image->getClientOriginalName(),
                ]);
            }
        }

        if ($request->has('tags')) {
            $project->tags()->attach($request->tags);
        }

        return redirect()->route('admin.projects.index')->with('success', __('Project created successfully!'));
    }

    public function show(Project $project)
    {
        $project->load(['category', 'tags', 'images']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function destroy(Project $project)
    {
        // Supprimer les images associées
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->name);
            $image->delete();
        }

        // Détacher les tags
        $project->tags()->detach();

        // Supprimer le projet
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', __('Project deleted successfully!'));
    }
}

