<?php

namespace App\Livewire\Front;

use App\Models\User;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Front\NewContactNotification;

class StoreContact extends Component
{
    public string $name;
    public string $email;
    public string $subject;
    public string $message;

    public function store()
    {
        // Validate Data
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Store Contact
        $contact = Contact::query()
                ->create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ]);
        
        // Send Notification to Admin and User (Role ID 1 is Admin) 
        Notification::send([$contact, User::query()->firstWhere('role_id', 1)], new NewContactNotification($contact));

        session()->flash('success', trans('Your message has been successfully sent to the platform administrator. You will receive an email as soon as possible.'));

        $this->redirectRoute('front.contact');
    }

    public function render()
    {
        return view('livewire.front.store-contact');
    }
}
