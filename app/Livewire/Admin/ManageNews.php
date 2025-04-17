<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManageNews extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $deleteId, $selectedNews, $publishId;
    public $fr_title;
    public $filterTitle = '';
    public $filterStatus = '';

    protected $queryString = [
        'filterTitle' => ['except' => ''],
        'filterStatus' => ['except' => '']
    ];

    public function updatingFilterTitle($value)
    {
        $this->resetPage();
    }

    public function updatingFilterStatus($value)
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->reset(['deleteId', 'selectedNews', 'publishId', 'fr_title']);
        $this->dispatch('closeModal');
    }

    public function showDetails($id)
    {
        $this->selectedNews = News::with('user')->findOrFail($id);
        $this->dispatch('openDetailsModal');
    }

    public function showDeleteForm($id)
    {
        $news = News::findOrFail($id);
        $this->deleteId = $news->id;
        $this->fr_title = $news->fr_title;
        $this->dispatch('openDeleteModal');
    }

    public function destroyNews()
    {
        try {
            $news = News::findOrFail($this->deleteId);
            if ($news->image && Storage::disk('public')->exists('news/' . $news->image)) {
                Storage::disk('public')->delete('news/' . $news->image);
            }
            $news->delete();
            session()->flash('success', __('News deleted successfully!'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while deleting the news: ') . $e->getMessage());
        }
    }

    public function showPublishForm($id)
    {
        $news = News::findOrFail($id);
        $this->publishId = $news->id;
        $this->fr_title = $news->fr_title;
        $this->dispatch('openPublishModal');
    }

    public function togglePublish()
    {
        try {
            $news = News::findOrFail($this->publishId);
            if ($news->published_at) {
                $news->published_at = null;
            } else {
                $news->published_at = now();
            }
            $news->save();
 
            session()->flash('success', $news->published_at ? __('News published successfully!') : __('News unpublished successfully!'));
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while updating the news: ') . $e->getMessage());
        }
    }

    public function render()
    {
        $query = News::with('user')->orderBy('created_at', 'desc');


        if ($this->filterTitle) {
            $query->where(function ($q) {
                $q->where('fr_title', 'like', '%' . $this->filterTitle . '%')
                    ->orWhere('en_title', 'like', '%' . $this->filterTitle . '%')
                    ->orWhere('fr_content', 'like', '%' . $this->filterTitle . '%')
                    ->orWhere('en_content', 'like', '%' . $this->filterTitle . '%');
            });
        }

        if ($this->filterStatus !== '') {
            $query->where('published_at', $this->filterStatus == 1 ? '!=' : '=', null);
        }

        return view('livewire.admin.manage-news', [
            'newsItems' => $query->paginate(7),
        ]);
    }
}
