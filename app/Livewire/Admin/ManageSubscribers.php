<?php

namespace App\Livewire\Admin;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSubscribers extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public $selectedSubscriber = null;
    public $showAddForm = false;

    public $email = '';
    public $name = '';

    protected $rules = [
        'email' => 'required|email|unique:subscribers,email',
        'name' => 'nullable|string|max:255',
    ];

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

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->resetValidation();
        $this->reset(['email', 'name']);
    }

    public function addSubscriber()
    {
        $this->validate();

        Subscriber::create([
            'email' => $this->email,
            'name' => $this->name,
            'status' => Subscriber::STATUS_ACTIVE,
            'token' => Subscriber::generateToken(),
            'subscribed_at' => now(),
        ]);

        $this->reset(['email', 'name', 'showAddForm']);
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => __('Subscriber added successfully!')
        ]);
    }

    public function confirmDelete($id)
    {
        $this->selectedSubscriber = Subscriber::find($id);
        $this->dispatch('openModal', 'deleteSubscriberModal');
    }

    public function deleteSubscriber()
    {
        if ($this->selectedSubscriber) {
            $this->selectedSubscriber->delete();
            $this->dispatch('closeModal', 'deleteSubscriberModal');
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => __('Subscriber deleted successfully!')
            ]);
        }
    }

    public function toggleStatus($id)
    {
        $subscriber = Subscriber::find($id);

        if ($subscriber) {
            $newStatus = $subscriber->status === Subscriber::STATUS_ACTIVE
                ? Subscriber::STATUS_UNSUBSCRIBED
                : Subscriber::STATUS_ACTIVE;

            $subscriber->update([
                'status' => $newStatus,
                'unsubscribed_at' => $newStatus === Subscriber::STATUS_UNSUBSCRIBED ? now() : null,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => $newStatus === Subscriber::STATUS_ACTIVE
                    ? __('Subscriber activated successfully!')
                    : __('Subscriber deactivated successfully!')
            ]);
        }
    }

    public function render()
    {
        $subscribers = Subscriber::query()
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $statusOptions = [
            Subscriber::STATUS_ACTIVE => __('Active'),
            Subscriber::STATUS_UNSUBSCRIBED => __('Unsubscribed'),
            Subscriber::STATUS_BOUNCED => __('Bounced')
        ];

        return view('livewire.admin.manage-subscribers', [
            'subscribers' => $subscribers,
            'statusOptions' => $statusOptions
        ]);
    }
}
