<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $fillable = [

        'tanggal_pinjam', 
        'tanggal_pengembalian',
        'status', 
        'anggota_id',
        'buku_id',

    ];
    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function kembali() // Nama singular karena hasOne
    {
        return $this->hasOne(Kembali::class, 'pinjam_id');
    }
}
