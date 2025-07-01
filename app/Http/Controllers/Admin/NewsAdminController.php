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
            'image' => 'required |image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'required |array|max:10',
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
     *
     * @param News $news
     * @return \Illuminate\View\View
     */
    public function edit(News $news)
    {
        // Charger les tags associés à la news
        $news->load('tags');

        // Récupérer tous les tags disponibles sous forme de tableau associatif (id => name)
        $availableTags = Tag::all()->pluck('name', 'id')->toArray();

        return view('admin.news.edit', compact('news', 'availableTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        // Validation des données
        $validated = $request->validate([
            'fr_title' => 'required|string|max:255',
            'en_title' => 'required|string|max:255',
            'fr_content' => 'required|string|min:10',
            'en_content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB max
            'tags' => 'nullable|array|max:10',
            'tags.*' => 'exists:tags,id',
            'published_at' => 'nullable',
            'remove_image' => 'nullable|boolean',
        ]);

        try {
            // Préparer les données pour la mise à jour
            $newsData = [
                'fr_title' => $validated['fr_title'],
                'en_title' => $validated['en_title'],
                'fr_content' => $validated['fr_content'],
                'en_content' => $validated['en_content'],
                'slug' => Str::slug($validated['en_title']) . '-' . time(),
                'published_at' => $request->boolean('published_at') ? now() : null,
            ];

            // Gestion de l'image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }
                // Stocker la nouvelle image
                $imagePath = $request->file('image')->store('news', 'public');
                $newsData['image'] = $imagePath;
            } elseif ($request->boolean('remove_image') && $news->image) {
                // Supprimer l'image existante si demandée
                Storage::disk('public')->delete($news->image);
                $newsData['image'] = null;
            }

            // Mettre à jour la news
            $news->update($newsData);

            // Synchroniser les tags
            if ($request->has('tags')) {
                $news->tags()->sync($validated['tags']);
            } else {
                $news->tags()->detach();
            }

            // Message de succès avec différenciation selon le statut
            $message = $request->boolean('save_as_draft') ? __('News saved as draft successfully!') : __('News updated successfully!');

            return redirect()
                ->route('admin.news.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', __('An error occurred: ') . $e->getMessage());
        }
    }
    /**
     * Upload d'image pour CKEditor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120', // 5 Mo max
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('news', 'public');
            $url = asset('storage/' . $path);
            return response()->json([
                'url' => $url
            ]);
        }
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}



