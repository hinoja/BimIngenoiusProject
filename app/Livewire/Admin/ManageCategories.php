<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ManageCategories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name; // Pour le formulaire d'ajout principal
    public $editName; // Pour le formulaire modal (ajout et édition)
    public $deleteId;
    public $selectedCategoryId;
    public $deleteCategory;
    public $selectedCategory;

    public function closeModal()
    {
        $this->reset(['editName', 'selectedCategory', 'deleteId', 'deleteCategory']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatch('closeModal');
    }

    public function showEditForm($id)
    {
        $category = Category::find($id);
        $this->reset(['editName', 'selectedCategory']);
        $this->resetErrorBag();
        $this->dispatch('openEditModal');
        $this->resetValidation();
        $this->selectedCategory = $category;
        $this->selectedCategoryId = $id;
        $this->editName = $category->name;
    }

    public function showCreateForm()
    {
        $this->reset(['editName', 'selectedCategory']);
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

        $this->reset(['name']);
        session()->flash('success', __('Category created successfully!'));
        return $this->redirect(route('admin.categories.index'), navigate: true); // Redirection pour afficher le flash
    }

    public function addCategoryModal()
    {
        $this->validate([
            'editName' => ['required', 'string', 'min:2', 'unique:categories,name'],
        ]);

        Category::create([
            'name' => $this->editName,
            'slug' => Str::slug($this->editName)
        ]);

        session()->flash('success', __('Category created successfully!'));
        $this->closeModal();
        return $this->redirect(route('admin.categories.index'), navigate: true); // Redirection pour afficher le flash
    }

    public function showDeleteForm($id)
    {
        $category = Category::find($id);
        $this->dispatch('openDeleteModal');
        $this->deleteId = $category->id;
        $this->deleteCategory = $category->name;
    }

    public function updateCategory()
    {
        $this->validate([
            'editName' => ['required', 'string', 'min:2', 'unique:categories,name,' . $this->selectedCategoryId . ',id'],
        ]);

        $category = Category::findOrFail($this->selectedCategoryId);
        $category->update([
            'name' => $this->editName,
            'slug' => Str::slug($this->editName)
        ]);

        session()->flash('success', __('Category updated successfully!'));
        $this->closeModal();
        return $this->redirect(route('admin.categories.index'), navigate: true); // Redirection pour afficher le flash
    }

    public function destroyCategory()
    {
        $category = Category::find($this->deleteId);

        if ($category) {
            $category->projects()->delete();
            $category->delete();
            session()->flash('success', __('Category deleted successfully!'));
        }

        $this->closeModal();
        return $this->redirect(route('admin.categories.index'), navigate: true); // Redirection pour afficher le flash
    }

    public function resetAttributes()
    {
        $this->reset(['name', 'editName', 'deleteId', 'selectedCategory', 'deleteCategory']);
    }

    public function render()
    {
        return view('livewire.admin.manage-categories', [
            'categories' => Category::query()->orderBy('name')->paginate(7),
        ]);
    }
}
