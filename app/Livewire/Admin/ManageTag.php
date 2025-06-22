<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ManageTag extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Variables pour l'ajout
    public $fr_name;
    public $en_name;

    // Variables pour l'édition
    public $editFrName;
    public $editEnName;
    public $selectedTagId;

    // Variable pour la suppression
    public $deleteId;

    // Variable pour la recherche
    public $searchTerm = '';

    protected $rules = [
        'fr_name' => 'required|min:2|unique:tags,fr_name',
        'en_name' => 'required|min:2|unique:tags,en_name',
        'editFrName' => 'required|min:2',
        'editEnName' => 'required|min:2',
    ];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function resetInputs()
    {
        $this->fr_name = '';
        $this->en_name = '';
        $this->editFrName = '';
        $this->editEnName = '';
        $this->selectedTagId = null;
        $this->deleteId = null;
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->resetInputs();
        $this->reset();
        $this->dispatch('closeModal');
    }

    public function addTag()
    {
        $this->validate([
            'fr_name' => 'required|min:2|unique:tags,fr_name',
            'en_name' => 'required|min:2|unique:tags,en_name',
        ]);

        try {
            Tag::create([
                'fr_name' => $this->fr_name,
                'en_name' => $this->en_name,
                'slug' => Str::slug($this->en_name),
            ]);

            session()->flash('success', __('Tag created successfully!'));
            $this->resetInputs();
            $this->resetPage();
            return redirect()->route('admin.tags.index');

        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function showEditForm($id)
    {
        $tag = Tag::findOrFail($id);
        $this->selectedTagId = $id;
        $this->editFrName = $tag->fr_name;
        $this->editEnName = $tag->en_name;
        $this->dispatch('openEditModal');
    }

    public function updateTag()
    {
        $this->validate([
            'editFrName' => 'required|min:2|unique:tags,fr_name,' . $this->selectedTagId,
            'editEnName' => 'required|min:2|unique:tags,en_name,' . $this->selectedTagId,
        ]);

        try {
            $tag = Tag::findOrFail($this->selectedTagId);
            $tag->update([
                'fr_name' => $this->editFrName,
                'en_name' => $this->editEnName,
                'slug' => Str::slug($this->editEnName),
            ]);

            session()->flash('success', __('Tag updated successfully!'));
            $this->closeModal();
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function showDeleteForm($id)
    {
        $this->deleteId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function deleteTag()
    {
        try {
            $tag = Tag::findOrFail($this->deleteId);
            $tag->delete();

            session()->flash('success', __('Tag deleted successfully!'));
            // $this->closeModal();
            return redirect()->route('admin.tags.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred: ') . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Tag::query();

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('fr_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('en_name', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return view('livewire.admin.manage-tag', [
            'tags' => $query->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}




