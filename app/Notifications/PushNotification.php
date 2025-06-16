<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;      //membangun format email.
use Illuminate\Notifications\Notification;

class PushNotification extends Notification
{
    use Queueable;          //antrian (queue) untuk diproses di latar belakang

    /**
     * Create a new notification instance.
     */
    public function __construct()       //menerima data yang perlu digunakan oleh notifikasi
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array      //saluran pengiriman yang akan digunakan oleh notifikasi.
    {
        return ['mail'];        //dikirim melalui email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage     //harus sama dengan function via
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')         //baris teks ke badan email
                    ->action('Notification Action', url('/'))       //URL yang akan dituju saat tombol diklik
                    ->line('Thank you for using our application!');
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
