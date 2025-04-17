<?php

namespace App\Livewire\Admin;

use App\Enums\SizeEnums;
use App\Enums\StatusEnums;
use App\Models\Category;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManageProjets extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $deleteId, $selectedProject;
    public $fr_title;
    public $filterTitle = '';
    public $filterCategory = '';
    public $filterStatus = '';
    public $filterSize = '';

    public function closeModal()
    {
        $this->reset(['deleteId', 'selectedProject', 'fr_title']);
        $this->dispatch('closeModal');
    }

    public function showDetails($id)
    {
        $this->selectedProject = Project::with(['category', 'images', 'tags'])->findOrFail($id);
        $this->dispatch('openDetailsModal');
    }

    public function showDeleteForm($id)
    {
        $project = Project::findOrFail($id);
        $this->deleteId = $project->id;
        $this->fr_title = $project->fr_title;
        $this->dispatch('openDeleteModal');
    }

    public function destroyProject()
    {
        try {
            $project = Project::findOrFail($this->deleteId);
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->name);
                $image->delete();
            }
            $project->delete();
            session()->flash('success', __('Project deleted successfully!'));
            return redirect()->route('admin.projects.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while deleting the project: ') . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Project::with(['images', 'category', 'tags'])->orderBy('created_at', 'desc');

        if ($this->filterTitle) {
            $query->where(function ($q) {
                $q->where('fr_title', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('en_title', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('fr_description', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('en_description', 'like', '%' . $this->filterTitle . '%');
            });
        }

        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->filterSize) {
            $query->where('size', $this->filterSize);
        }

        return view('livewire.admin.manage-projets', [
            'projects' => $query->paginate(7),
            'categories' => Category::orderBy('created_at')->get(),
            'statuses' => StatusEnums::cases(),
            'sizes' => SizeEnums::cases(),
        ]);
    }
}
