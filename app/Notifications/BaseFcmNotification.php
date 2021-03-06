<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use williamcruzme\FCM\Messages\FcmMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class BaseFcmNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    abstract public function toArray($notifiable): array;

    /**
     * Get the Firebase Message representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \williamcruzme\FCM\Messages\FcmMessage
     */
    abstract public function toFcm($notifiable): FcmMessage;
    
    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['fcm'];
    }
}
