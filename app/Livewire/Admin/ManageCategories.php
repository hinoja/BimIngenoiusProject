<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageCategories extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $fr_name, $en_name, $description, $image;
    public $editFrName, $editEnName, $editDescription, $editImage;
    public $selectedCategoryId, $deleteId;
    public $selectedCategory;
    public $currentPage = 1;
    public $searchTerm = ''; // Ajout de la variable de recherche

    protected $queryString = [
        'searchTerm' => ['except' => '']
    ];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->reset(['fr_name', 'en_name', 'editFrName', 'editEnName', 'editDescription', 'editImage', 'selectedCategory', 'deleteId']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closeModal');
    }
    public function updatingCurrentPage()
    {
        $this->resetPage();
    }

    public function showEditForm($id)
    {
        $category = Category::find($id);
        if (!$category) {
            session()->flash('error', __('Category not found!'));
            return;
        }
        $this->reset(['editFrName', 'editEnName', 'editDescription', 'editImage', 'selectedCategory']);
        $this->resetErrorBag();
        $this->dispatch('openEditModal');
        $this->resetValidation();
        $this->selectedCategory = $category;
        $this->selectedCategoryId = $id;
        $this->editFrName = $category->fr_name;
        $this->editEnName = $category->en_name;
        $this->editDescription = $category->description;
    }

    public function showCreateForm()
    {
        $this->reset(['fr_name', 'en_name', 'description', 'image']);
        $this->resetErrorBag();
        $this->dispatch('openModal');
        $this->resetValidation();
    }

    public function addCategory()
    {
        $this->validate([
            'fr_name' => ['required', 'string', 'min:2', 'unique:categories,fr_name'],
            'en_name' => ['required', 'string', 'min:2', 'unique:categories,en_name'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            $imagePath = $this->image ? $this->image->store('categories', 'public') : null;

            Category::create([
                'fr_name' => $this->fr_name,
                'en_name' => $this->en_name,
                'slug' => Str::slug($this->en_name),
                'description' => strip_tags($this->description, '<p><br><ul><ol><li><strong><em><u><h1><h2><h3><h4><h5><h6>'),
                'image' => $imagePath,
            ]);

            $this->reset(['fr_name', 'en_name', 'description', 'image']);
            session()->flash('success', __('Category created successfully!'));
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while creating the category: ') . $e->getMessage());
        }

        return $this->redirect(route('admin.categories.index'), navigate: true);
    }

    public function updateCategory()
    {
        $this->validate([
            'editFrName' => 'required|string|min:2|unique:categories,fr_name,' . $this->selectedCategoryId,
            'editEnName' => 'required|string|min:2|unique:categories,en_name,' . $this->selectedCategoryId,
            'editDescription' => 'nullable|string',
            'editImage' => 'nullable|image|max:2048',
        ]);

        try {
            $category = Category::findOrFail($this->selectedCategoryId);

            if ($this->editImage) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $imagePath = $this->editImage->store('categories', 'public');
                $category->image = $imagePath;
            }

            $cleanDescription = strip_tags($this->editDescription, '<p><br><ul><ol><li><strong><em><u><h1><h2><h3><h4><h5><h6>');

            $category->update([
                'fr_name' => $this->editFrName,
                'en_name' => $this->editEnName,
                'slug' => Str::slug($this->editEnName),
                'description' => $cleanDescription,
            ]);

            session()->flash('success', __('Category updated successfully!'));
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while updating the category: ') . $e->getMessage());
        }

        return $this->redirect(route('admin.categories.index'), navigate: true);
    }

    public function showDeleteForm($id)
    {
        $category = Category::findOrFail($id);
        $this->deleteId = $category->id;
        $this->fr_name = $category->fr_title;
        $this->dispatch('openDeleteModal');
    }

    public function destroyCategory()
    {
        $category = Category::find($this->deleteId);

        if ($category) {
            try {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $category->delete();
                session()->flash('success', __('Category deleted successfully!'));
            } catch (\Exception $e) {
                session()->flash('error', __('An error occurred while deleting the category: ') . $e->getMessage());
            }
            return redirect()->route('admin.categories.index');
        } else {
            session()->flash('error', __('Category not found!'));
        }

        $this->closeModal();
    }
    public function showDetails($id)
    {
        $this->selectedCategory = Category::findOrFail($id); 
        $this->dispatch('openDetailsModal');
    }
    public function render()
    {
        $query = Category::query()->orderBy('created_at', 'desc');

        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('fr_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('en_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('fr_description', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('en_description', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return view('livewire.admin.manage-categories', [
            'categories' => $query->paginate(10)
        ]);
    }
}

