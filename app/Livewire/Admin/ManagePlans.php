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
    public $fr_title; // Pour la confirmation de suppression ou publication
    public $filterTitle = '';
    public $filterStatus = '';
    public $isActive; // Pour stocker l'état actuel de is_active dans la modale

    public function closeModal()
    {
        $this->reset(['deleteId', 'selectedPlan', 'publishId', 'fr_title', 'isActive']);
        $this->dispatch('closeModal');
    }

    public function showDetails($id)
    {
        $this->selectedPlan = Plan::with('user')->findOrFail($id);
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
            if ($plan->image) {
                Storage::disk('public')->delete($plan->image);
            }
            $plan->delete();
            session()->flash('success', __('Plan deleted successfully!'));
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while deleting the plan: ') . $e->getMessage());
        }
    }

    // Nouvelle méthode pour afficher la modale de publication
    public function showPublishForm($id)
    {
        $plan = Plan::findOrFail($id);
        $this->publishId = $plan->id;
        $this->fr_title = $plan->fr_title;
        $this->isActive = $plan->is_active; // Stocke l'état actuel
        $this->dispatch('openPublishModal');
    }

    // Nouvelle méthode pour confirmer la publication/dépublication
    public function confirmPublish()
    {
        try {
            $plan = Plan::findOrFail($this->publishId);
            $plan->is_active = !$plan->is_active; // Inverse l'état actuel
            $plan->save();
            session()->flash('success', $plan->is_active ? __('Plan published successfully!') : __('Plan unpublished successfully!'));
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', __('An error occurred while updating the plan: ') . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Plan::with('user')->orderBy('created_at', 'desc');

        if ($this->filterTitle) {
            $query->where('fr_title', 'like', '%' . $this->filterTitle . '%')
                  ->orWhere('en_title', 'like', '%' . $this->filterTitle . '%');
        }

        if ($this->filterStatus !== '') {
            $query->where('is_active', $this->filterStatus);
        }

        return view('livewire.admin.manage-plans', [
            'plans' => $query->paginate(7),
        ]);
    }
}
