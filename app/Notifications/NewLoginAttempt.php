<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewLoginAttempt extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param mixed $attempt
     *
     * @return void
     */
    public function __construct($attempt)
    {
        $this->attempt = $attempt;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return with(new MailMessage)
            ->from(env('ADMIN_MAIL_ADDRESS'))
            ->subject('Login Your Account')
            ->greeting("Hello {$this->attempt->user->name}!")
            ->line('Please click the button below to get access to the application, which will be valid only for 15 minutes.')
            ->action('Login to your account', URL::temporarySignedRoute('login.token.validate', now()->addMinutes(15), [$this->attempt->token]))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
