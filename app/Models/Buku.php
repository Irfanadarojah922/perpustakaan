<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'isbn',
        'jumlah_eksemplar',
        'jumlah_tersedia',
        'deskripsi',
        'foto',
    ];

    protected $appends = [              //mengubah data buku jadi bentuk JSON untuk API
        "foto_url"
    ];

    public function getFotoUrlAttribute()                   //membuat link lengkap ke gambar bukunya
    {
        return url(Storage::url("buku/" . $this->foto));
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class, 'buku_id');
    }
}
