<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'nama_kategori');
    }

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class, 'buku_id');
    }
}
