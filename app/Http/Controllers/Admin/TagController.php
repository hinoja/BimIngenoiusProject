<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tags.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fr_name' => 'required|string|min:2|unique:tags,fr_name',
            'en_name' => 'required|string|min:2|unique:tags,en_name',
        ]);

        try {
            Tag::create([
                'fr_name' => $request->fr_name,
                'en_name' => $request->en_name,
                'slug' => Str::slug($request->en_name),
            ]);

            return redirect()->route('admin.tags.index')
                ->with('success', __('Tag created successfully!'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('admin.tags.index')
                ->with('success', __('Tag deleted successfully!'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }
}

