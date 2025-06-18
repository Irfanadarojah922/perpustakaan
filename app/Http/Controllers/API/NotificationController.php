<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;            //model user
use App\Notifications\PushNotification;         //class notification
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendTestNotification()
    {
        $user = User::find(1); 

        if ($user) {
            $user->notify(new PushNotification(
                'Notifikasi Baru!', // Judul notifikasi
                'Anda memiliki pesan baru!', // Isi notifikasi
                ['key_tambahan' => 'nilai_tambahan']
            ));
            return "Notifikasi berhasil dikirim ke pengguna ID: " . $user->id;
        }

        return "Pengguna tidak ditemukan.";
    }
}
