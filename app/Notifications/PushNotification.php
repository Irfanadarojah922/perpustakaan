<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;      //membangun format email.
use Illuminate\Notifications\Notification;
use NotificationChannels\fcm\FcmMessage;

class PushNotification extends Notification
{
    use Queueable;          //antrian (queue) untuk diproses di latar belakang

    protected $title;
    protected $body;
    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $body, $data = [])       //menerima data yang perlu digunakan oleh notifikasi
    {
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array      //saluran pengiriman yang akan digunakan untuk notifikasi
    {
        return ['firebase'];        //dikirim melalui firebase
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toFirebase($notifiable)     //harus sama dengan function via
    {
        return (new FcmMessage)
                ->content([
                    'title' => $this->title,
                    'body' => $this->body,   
                ])
                ->data(array_merge([
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK', // Contoh untuk aplikasi mobile
                    'message' => 'Ini adalah konten pesan tambahan.',
                ], $this->data));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
