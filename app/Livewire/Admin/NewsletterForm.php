<?php

namespace App\Livewire\Admin;

use App\Models\Newsletter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewsletterForm extends Component
{
    public $newsletterId;
    public $subject = '';
    public $content = '';
    public $status = 'draft';
    public $scheduledFor = null;

    protected $rules = [
        'subject' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,scheduled',
        'scheduledFor' => 'nullable|date|after:now',
    ];

    protected $messages = [
        'subject.required' => 'Le sujet est obligatoire.',
        'content.required' => 'Le contenu est obligatoire.',
        'scheduledFor.after' => 'La date programmée doit être dans le futur.',
    ];

    public function mount($newsletterId = null)
    {
        $this->newsletterId = $newsletterId;

        if ($newsletterId) {
            $newsletter = Newsletter::findOrFail($newsletterId);
            $this->subject = $newsletter->subject;
            $this->content = $newsletter->content;
            $this->status = $newsletter->status;
            $this->scheduledFor = $newsletter->scheduled_for ? $newsletter->scheduled_for->format('Y-m-d\TH:i') : null;
        }
    }

    public function updatedStatus()
    {
        if ($this->status !== 'scheduled') {
            $this->scheduledFor = null;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'subject' => $this->subject,
            'content' => $this->content,
            'status' => $this->status,
            'scheduled_for' => $this->scheduledFor,
            'user_id' => Auth::id(),
        ];

        if ($this->newsletterId) {
            $newsletter = Newsletter::findOrFail($this->newsletterId);
            $newsletter->update($data);
            $message = __('Newsletter updated successfully!');
        } else {
            Newsletter::create($data);
            $message = __('Newsletter created successfully!');
        }

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => $message
        ]);

        return redirect()->route('admin.newsletters.index');
    }

    public function render()
    {
        return view('livewire.admin.newsletter-form');
    }
}
