<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    use HasFactory;
    protected $fillable = [

        'pinjam_id',
        'tanggal_kembali',
        'denda',
        'keterangan',
    ];
    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class, 'pinjam_id');
    }

    // Access anggota THROUGH pinjam
    public function anggota()
    {
        return $this->hasOneThrough(
            Anggota::class,   // Final model
            Pinjam::class,    // Intermediate model
            'id',             // Foreign key on Pinjam (referencing Anggota)
            'id',             // Primary key on Anggota
            'pinjam_id',      // Foreign key on Kembali
            'anggota_id'      // Foreign key on Pinjam
        );
    }

    // Access buku THROUGH pinjam
    public function buku()
    {
        return $this->hasOneThrough(
            Buku::class,
            Pinjam::class,
            'id',            
            'id',      
            'pinjam_id',   
            'buku_id'
        );
    }
}
