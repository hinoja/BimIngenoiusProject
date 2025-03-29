<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManagePlans extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $deleteId, $selectedPlan, $publishId;
    public $fr_title;
    public $filterTitle = '';
    public $filterStatus = '';

    public function closeModal()
    {
        $this->reset(['deleteId', 'selectedPlan', 'publishId', 'fr_title']);
        $this->dispatch('closeModal');
    }

    public function showDetails($id)
    {
        $this->selectedPlan = Plan::with(['user', 'images'])->findOrFail($id);
        $this->dispatch('openDetailsModal');
    }

    public function showDeleteForm($id)
    {
        $plan = Plan::findOrFail($id);
        $this->deleteId = $plan->id;
        $this->fr_title = $plan->fr_title;
        $this->dispatch('openDeleteModal');
    }

    public function destroyPlan()
    {
        try {
            $plan = Plan::findOrFail($this->deleteId);
            foreach ($plan->images as $image) {
                Storage::disk('public')->delete($image->name);
                $image->delete();
            }
            $plan->delete();
            session()->flash('success', __('Plan deleted successfully!'));
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while deleting the plan: ') . $e->getMessage());
        }
    }

    public function showPublishForm($id)
    {
        $plan = Plan::findOrFail($id);
        $this->publishId = $plan->id;
        $this->fr_title = $plan->fr_title;
        $this->dispatch('openPublishModal');
    }

    public function togglePublish()
    {
        try {
            $plan = Plan::findOrFail($this->publishId);
            $plan->published_at = $plan->published_at ? null : now();
            $plan->save();
            session()->flash('success', $plan->published_at ? __('Plan published successfully!') : __('Plan unpublished successfully!'));
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while updating the plan: ') . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Plan::with(['user', 'images'])->orderBy('created_at', 'desc');

        if ($this->filterTitle) {
            $query->where(function ($q) {
                $q->where('fr_title', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('en_title', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('fr_description', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('en_description', 'like', '%' . $this->filterTitle . '%');
            });
        }

        if ($this->filterStatus !== '') {
            $query->where('published_at', $this->filterStatus == 1 ? '!=' : '=', null);
        }

        return view('livewire.admin.manage-plans', [
            'plans' => $query->paginate(7),
        ]);
    }
}
