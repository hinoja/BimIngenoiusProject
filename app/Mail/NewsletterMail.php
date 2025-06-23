<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * La newsletter à envoyer.
     *
     * @var \App\Models\Newsletter
     */
    public $newsletter;

    /**
     * L'abonné à qui envoyer la newsletter.
     *
     * @var \App\Models\Subscriber
     */
    public $subscriber;

    /**
     * Créer une nouvelle instance du message.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @param  \App\Models\Subscriber  $subscriber
     * @return void
     */
    public function __construct(Newsletter $newsletter, Subscriber $subscriber)
    {
        $this->newsletter = $newsletter;
        $this->subscriber = $subscriber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->newsletter->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
