<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsAdminController extends Controller
{


    /**²
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableTags = Tag::all()->pluck('name', 'id')->toArray();
        return view('admin.news.create', compact('availableTags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fr_title' => 'required|string|max:255',
            'en_title' => 'required|string|max:255',
            'fr_content' => 'required|string|min:10',
            'en_content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'nullable|array|max:10',
            'tags.*' => 'exists:tags,id',
        ]);

        try {
            if ($request->hasFile('image')) {
                // $image = $request->file('image');
                // $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $image->store('news/', $imageName, 'public');
                // $newsData['image'] = $imageName;
                $imagePath = $request->file('image')->store('news', 'public');

            }
            $newsData = [
                'fr_title' => $validated['fr_title'],
                'en_title' => $validated['en_title'],
                'fr_content' => strip_tags($validated['fr_content']),
                'en_content' => strip_tags($validated['en_content']),
                'slug' => Str::slug($validated['en_title']) . '-' . time(),
                'user_id' => Auth::id(),
                'published_at' => $request->boolean('published_at') ? now() : null,
                'image' => $imagePath,
            ];


            $news = News::create($newsData);

            if ($request->has('tags')) {
                $news->tags()->sync($request->tags);
            }

            return redirect()
                ->route('admin.news.index')
                ->with('success', __('News created successfully!'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $availableTags = Tag::all()->pluck('name', 'id')->toArray();
        return view('admin.news.edit', compact('news', 'availableTags'));
    }
}
