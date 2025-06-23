<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserCredentials extends Notification implements ShouldQueue
{
    use Queueable;

    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Your Account Information'))
            ->greeting(__('Hello') . ' ' . $notifiable->name . '!')
            ->line(__('An account has been created for you on our platform.'))
            ->line(__('Email') . ': ' . $notifiable->email)
            ->line(__('Password') . ': ' . $this->password)
            ->line(__('Please change your password after your first login for security reasons.'))
            ->action(__('Login Now'), url(route('login')))
            ->line(__('Thank you for using our application!'));
    }
}