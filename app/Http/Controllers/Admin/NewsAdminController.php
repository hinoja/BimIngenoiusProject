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
                'fr_content' => $validated['fr_content'],
                'en_content' => $validated['en_content'],
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        // Cette méthode n'est pas utilisée car nous utilisons Livewire pour l'édition
        // Mais nous la gardons au cas où nous voudrions revenir à une approche traditionnelle
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
            $newsData = [
                'fr_title' => $validated['fr_title'],
                'en_title' => $validated['en_title'],
                'fr_content' => $validated['fr_content'],
                'en_content' => $validated['en_content'],
                'slug' => Str::slug($validated['en_title']) . '-' . time(),
                'published_at' => $request->boolean('publish_now') ? now() : null,
            ];

            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }

                $imagePath = $request->file('image')->store('news', 'public');
                $newsData['image'] = $imagePath;
            } elseif ($request->has('remove_image') && $news->image) {
                Storage::disk('public')->delete($news->image);
                $newsData['image'] = null;
            }

            $news->update($newsData);

            if ($request->has('tags')) {
                $news->tags()->sync($request->tags);
            } else {
                $news->tags()->detach();
            }

            return redirect()
                ->route('admin.news.index')
                ->with('success', __('News updated successfully!'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }
}



