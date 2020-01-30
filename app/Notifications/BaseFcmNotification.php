<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use williamcruzme\FCM\Messages\FcmMessage;

abstract class BaseFcmNotification extends Notification implements ShouldQueue
{

    use Queueable;
    
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

    /**
     * Get the Firebase Message representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \williamcruzme\FCM\Messages\FcmMessage
     */
    abstract public function toFcm($notifiable): FcmMessage;

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    abstract public function toArray($notifiable): array;
}
