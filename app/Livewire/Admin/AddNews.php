<?php

namespace App\Livewire\Admin;

use App\Models\News;
use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddNews extends Component
{
    use WithFileUploads;

    public $fr_title = '';
    public $en_title = '';
    public $fr_content = '';
    public $en_content = '';
    public $image;
    public $tags = [];
    public $publish_now = false;
    public $activeTab = 'fr';

    protected $rules = [
        'fr_title' => 'required|string|max:255',
        'en_title' => 'required|string|max:255',
        'fr_content' => 'required|string|min:10',
        'en_content' => 'required|string|min:10',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'tags' => 'array|max:10',
        'publish_now' => 'boolean',
    ];

    protected $messages = [
        'fr_title.required' => 'The French title is required.',
        'fr_title.max' => 'The French title cannot exceed 255 characters.',
        'en_title.required' => 'The English title is required.',
        'en_title.max' => 'The English title cannot exceed 255 characters.',
        'fr_content.required' => 'The French content is required.',
        'fr_content.min' => 'The French content must be at least 10 characters.',
        'en_content.required' => 'The English content is required.',
        'en_content.min' => 'The English content must be at least 10 characters.',
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be a JPG, JPEG, or PNG file.',
        'image.max' => 'The image size cannot exceed 2MB.',
        'tags.array' => 'Tags must be selected from the list.',
        'tags.max' => 'You can select up to 10 tags.',
    ];

    public function mount()
    {
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

    public function save()
    {
        $this->validate();

        try {
            $newsData = [
                'fr_title' => $this->fr_title,
                'en_title' => $this->en_title,
                'fr_content' => $this->fr_content,
                'en_content' => $this->en_content,
                'slug' => Str::slug($this->en_title) . '-' . time(),
                'user_id' => Auth::id(),
                'published_at' => $this->publish_now ? now() : null,
            ];

            if ($this->image) {
                $imageName = time() . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/news', $imageName, 'public');
                $newsData['image'] = $imageName;
            }

            $news = News::create($newsData);

            if (!empty($this->tags)) {
                $news->tags()->sync($this->tags);
            }

            session()->flash('success', __('News created successfully!'));
            $this->resetForm();
            return $this->redirect(route('admin.news.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }
    public function removeImage()
    {
        $this->image = null;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    private function resetForm()
    {
        $this->fr_title = '';
        $this->en_title = '';
        $this->fr_content = '';
        $this->en_content = '';
        $this->image = null;
        $this->tags = [];
        $this->publish_now = false;
        $this->activeTab = 'fr';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.add-news', [
            'availableTags' => \App\Models\Tag::all()->pluck('name', 'id')->toArray(),
        ]);
    }
}

