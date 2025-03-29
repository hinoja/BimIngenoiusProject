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

    protected $paginationTheme = 'bootstrap';

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
        return view('livewire.admin.manage-messages', ['contacts' => Contact::query()->latest()->paginate(5)]);
    }
}
