<?php

namespace App\Livewire\Admin;

use App\Models\News;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditNews extends Component
{
    use WithFileUploads;

    public News $news;
    public $fr_title;
    public $en_title;
    public $fr_content;
    public $en_content;
    public $tags = [];
    public $publish_now = false;
    public $newImage;
    public $currentImage;

    protected $rules = [
        'fr_title' => 'required|string|max:255',
        'en_title' => 'required|string|max:255',
        'fr_content' => 'required|string|min:10',
        'en_content' => 'required|string|min:10',
        'newImage' => 'nullable|image|max:2048',
        'tags' => 'nullable|array',
    ];

    public function mount(News $news)
    {
        $this->news = $news;
        $this->fr_title = $news->fr_title;
        $this->en_title = $news->en_title;
        $this->fr_content = $news->fr_content;
        $this->en_content = $news->en_content;
        $this->tags = $news->tags->pluck('id')->toArray();
        $this->publish_now = $news->published_at ? true : false;
        $this->currentImage = $news->image;

        $this->dispatch('initSummernote');
    }

    public function updatedFrContent()
    {
        $this->dispatch('contentUpdated', ['editor' => 'fr_content', 'content' => $this->fr_content]);
    }

    public function updatedEnContent()
    {
        $this->dispatch('contentUpdated', ['editor' => 'en_content', 'content' => $this->en_content]);
    }

    public function removeImage()
    {
        $this->newImage = null;
    }

    public function deleteCurrentImage()
    {
        $this->currentImage = null;
    }

    public function update()
    {
        $this->validate();

        try {
            $newsData = [
                'fr_title' => $this->fr_title,
                'en_title' => $this->en_title,
                'fr_content' => $this->fr_content,
                'en_content' => $this->en_content,
                'slug' => Str::slug($this->en_title) . '-' . time(),
                'published_at' => $this->publish_now ? now() : null,
            ];

            // Traitement de l'image
            if ($this->newImage) {
                // Supprimer l'ancienne image si elle existe
                if ($this->news->image && Storage::disk('public')->exists($this->news->image)) {
                    Storage::disk('public')->delete($this->news->image);
                }

                $imagePath = $this->newImage->store('news', 'public');
                $newsData['image'] = $imagePath;
            } elseif ($this->currentImage === null && $this->news->image) {
                // Si l'image actuelle a été supprimée
                Storage::disk('public')->delete($this->news->image);
                $newsData['image'] = null;
            }

            // Mise à jour de la news
            $this->news->update($newsData);

            // Mise à jour des tags
            $this->news->tags()->sync($this->tags);

            session()->flash('success', __('News updated successfully!'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-news', [
            'availableTags' => Tag::all()->pluck('name', 'id')->toArray(),
        ]);
    }
}


