<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Brian2694\Toastr\Facades\Toastr;


class ManageCategories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name;
    public $deleteId;
    public $selectedCategoryId;
    public $deleteCategory;
    public $selectedCategory;

    public function closeModal()
    {
        $this->reset(['name', 'selectedCategory', 'deleteId', 'deleteCategory']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closeModal');
    }

    public function showEditForm($id)
    {
        $category = Category::find($id);
        $this->reset(['name', 'selectedCategory']);
        $this->resetErrorBag();
        $this->dispatch('openEditModal');
        $this->resetValidation();
        $this->selectedCategory = $category;
        $this->selectedCategoryId = $id;
        $this->name = $this->selectedCategory->name;
    }

    public function showCreateForm()
    {
        $this->reset(['name', 'selectedCategory']);
        $this->resetErrorBag();
        $this->dispatch('openModal');
        $this->resetValidation();
    }





    public function addCategory()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'unique:categories,name'],
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->dispatch('showToast', 'success', __('Category created successfully!'));
        $this->closeModal();
        $this->resetPage();
    }

    public function showDeleteForm($id)
    {
        $category = Category::find($id);
        $this->dispatch('openDeleteModal');
        $this->deleteId = $category->id;
        $this->name = $category->name;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'unique:categories,name,' . $this->selectedCategoryId . ',id'],
        ]);

        // Récupérer la catégorie via l'ID
        $category = Category::findOrFail($this->selectedCategoryId);

        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->dispatch('showToast', 'success', __('Category updated successfully!'));
        $this->closeModal();
    }

    public function destroyCategory()
    {
        $category = Category::find($this->deleteId);

        if ($category) {
            $category->projects()->delete();
            $category->delete();
            $this->dispatch('showToast', 'success', __('Category deleted successfully!'));
            $this->resetPage();
        }

        $this->closeModal();
    }

    public function resetAttributes()
    {
        $this->reset(['name', 'deleteId', 'selectedCategory', 'deleteCategory']);
    }

    public function render()
    {
        return view('livewire.admin.manage-categories', [
            'categories' => Category::query()->orderBy('name')->paginate(7),
        ]);
    }
}
