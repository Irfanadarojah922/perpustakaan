<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $fillable = [

        'tanggal_pinjam',
        'tanggal_kembali',
        // 'status_pengembalian',
        'anggota_id',
        'buku_id',
        'kategori_id',

    ];
    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function kembalis()
    {
        return $this->belongsTo(Kembali::class, 'kembali_id');
    }
}
