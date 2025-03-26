<?php

namespace App\Notifications\Front;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewQuoteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Quote $quote)
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->when(
                    $notifiable->role_id === 1,
                    fn($mail) => $mail->subject(trans('New Quote Submitted') . ' - ' . $this->quote->title),
                    fn($mail) => $mail->subject(trans('Quote Submission Confirmation') . ' - ' . $this->quote->title),
                )
                ->lineIf(
                    $notifiable->role_id === 1,
                    trans('A new quote has been submitted by: ') . $this->quote->customer->first_name . ' ' . $this->quote->customer->last_name . '.'
                )
                ->lineIf(
                    $notifiable->role_id === 1,
                    trans('Quote Details:') . ' ' . $this->quote->details
                )
                ->lineIf(
                    $notifiable->role_id === 1,
                    trans('Budget: :budget :currency', [
                        'budget' => $this->quote->budget,
                        'currency' => $this->quote->currency,
                    ])
                )
                ->lineIf(
                    $notifiable->role_id !== 1,
                    trans('Your quote titled ":title" has been successfully submitted. We will get back to you as soon as possible.', [
                        'title' => $this->quote->title,
                    ])
                )
                ->when(
                    $notifiable->role_id === 1,
                    fn($mail) => $mail->action(trans('View Quote'), url('/admin/quotes/' . $this->quote->id)),
                    fn($mail) => $mail->action(trans('Go to website'), url('/quotes/' . $this->quote->id)),
                );
    }
}
