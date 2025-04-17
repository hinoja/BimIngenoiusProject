<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fr_name' => ['required', 'string', 'min:2', 'unique:categories,fr_name'],
            'en_name' => ['required', 'string', 'min:2', 'unique:categories,en_name'],
            'fr_description' => ['required', 'string'],
            'en_description' => ['required', 'string'],
            'image' => ['required', 'max:2048', 'mimes:png,jpg,png,jpeg'],
        ]); 
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                 $imagePath = $request->file('image')->store('categories', 'public');
            }

            Category::create([
                'fr_name' => $request->fr_name,
                'en_name' => $request->en_name,
                'slug' => Str::slug($request->en_name),
                'fr_description' =>  $request->fr_description,
                'en_description' =>  $request->en_description,
                'image' => $imagePath,
            ]);

            session()->flash('success', __('Category created successfully!'));
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while creating the category: ') . $e->getMessage());
        }

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
