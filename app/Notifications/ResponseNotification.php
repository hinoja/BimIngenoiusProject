<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResponseNotification extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public array $data) {}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $hour = date('H');

        $greeting = ($hour > 17) ? trans('Good evening ') : (($hour > 12 && $hour <= 18) ? trans('Good afternoon ') : trans('Good morning '));

        return (new MailMessage)
            ->greeting($greeting . $notifiable->name)
            ->subject(trans('New response notification'))
            ->line(trans('You have received a response for your message sent on ') . $this->data['created_at'] . trans(' with the subject: ') . $this->data['subject'])
            ->line(trans('The content of the response is: ') . $this->data['response'])
            ->action(trans('Go to website'), url('/'));
    }
}
