<?php

namespace App\Livewire\Admin;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Jobs\SendNewsletterJob;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ManageNewsletters extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $selectedNewsletter = null;
    public $confirmingDelete = false;
    public $confirmingSend = false;
    public $subscribersCount = 0;

    protected $listeners = ['refreshNewsletters' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function confirmDelete($id)
    {
        $this->selectedNewsletter = Newsletter::find($id);
        $this->dispatch('openModal', 'deleteNewsletterModal');
    }

    public function deleteNewsletter()
    {
        if ($this->selectedNewsletter) {
            $this->selectedNewsletter->delete();
            $this->dispatch('closeModal', 'deleteNewsletterModal');
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => __('Newsletter deleted successfully!')
            ]);
        }
    }

    public function confirmSend($id)
    {
        $this->selectedNewsletter = Newsletter::find($id);
        
        if ($this->selectedNewsletter) {
            // Compter les abonnés actifs
            $this->subscribersCount = \App\Models\Subscriber::where('status', 'active')->count();
            
            // Ouvrir le modal
            $this->dispatch('openModal', 'sendNewsletterModal');
        }
    }

    public function sendNewsletter()
    {
        if (!$this->selectedNewsletter) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => __('No newsletter selected')
            ]);
            return;
        }

        try {
            // Vérifier s'il y a des abonnés actifs
            $subscribersCount = Subscriber::where('status', 'active')->count();
            
            if ($subscribersCount == 0) {
                $this->dispatch('alert', [
                    'type' => 'warning',
                    'message' => __('There are no active subscribers to send to')
                ]);
                return;
            }

            // Mettre à jour le statut
            $this->selectedNewsletter->update([
                'status' => Newsletter::STATUS_SCHEDULED
            ]);

            // Dispatch le job pour envoyer la newsletter
            SendNewsletterJob::dispatch($this->selectedNewsletter);

            // Fermer le modal
            $this->dispatch('hideModal', 'sendNewsletterModal');
            
            // Afficher un message de succès
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => __('Newsletter queued for sending!')
            ]);
        } catch (\Exception $e) {
            // Gérer les erreurs
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => __('Error sending newsletter: ') . $e->getMessage()
            ]);
        }
    }

    public function getListeners()
    {
        return [
            'refreshNewsletters' => '$refresh',
            'openModal' => 'handleOpenModal',
            'closeModal' => 'handleCloseModal'
        ];
    }

    public function handleOpenModal($modalId)
    {
        $this->dispatch('show-modal', ['modalId' => $modalId]);
    }

    public function handleCloseModal($modalId)
    {
        $this->dispatch('hide-modal', ['modalId' => $modalId]);
    }

    public function render()
    {
        $newsletters = Newsletter::query()
            ->when($this->search, function ($query) {
                $query->where('subject', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $statusOptions = [
            Newsletter::STATUS_DRAFT => __('Draft'),
            Newsletter::STATUS_SCHEDULED => __('Scheduled'),
            Newsletter::STATUS_SENDING => __('Sending'),
            Newsletter::STATUS_SENT => __('Sent'),
            Newsletter::STATUS_FAILED => __('Failed')
        ];

        return view('livewire.admin.manage-newsletters', [
            'newsletters' => $newsletters,
            'statusOptions' => $statusOptions,
            'subscribersCount' => Subscriber::where('status', Subscriber::STATUS_ACTIVE)->count()
        ]);
    }
}




