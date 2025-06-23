<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\ResponseNotification;
use Illuminate\Support\Facades\Notification;


class ManageMessages extends Component
{
    use WithPagination;

    public $reply;
    public $displayContact;
    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterStatus = '';
        $this->perPage = 10;
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->reset(['reply', 'displayContact']);
        $this->resetErrorBag();
        $this->dispatch('closeModal');
    }

    public function showModalForm(Contact $contact)
    {
        $this->resetValidation();
        $this->dispatch('openModal');
        $this->displayContact = $contact;
    }

    public function replyMessage(Contact $contact)
    {
        $this->dispatch('showFormReply');
        $response = $this->validate([
            'reply' => ['required', 'string'],
        ]);
        $contact->response = $response['reply'];
        $contact->save();

        $data = [
            'subject' => $contact->subject,
            'created_at' => $contact->created_at,
            'response' => $contact->response,
        ];

        Notification::send($contact, new ResponseNotification($data));

        $this->closeModal();
        session()->flash('success', trans('The response was successfully sent to ').$contact->name);

        return redirect()->route('admin.contacts.index');
    }

    public function render()
    {
        $query = Contact::query();

        // Appliquer les filtres de recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%')
                  ->orWhere('message', 'like', '%' . $this->search . '%');
            });
        }

        // Filtrer par statut (répondu ou non)
        if ($this->filterStatus !== '') {
            if ($this->filterStatus === '1') {
                $query->whereNotNull('response');
            } else {
                $query->whereNull('response');
            }
        }

        // Appliquer le tri
        $query->orderBy($this->sortField, $this->sortDirection);

        $contacts = $query->paginate($this->perPage);

        return view('livewire.admin.manage-messages', [
            'contacts' => $contacts,
            'statusOptions' => [
                '0' => __('Not Answered'),
                '1' => __('Answered')
            ]
        ]);
    }
}

