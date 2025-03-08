<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    use HasFactory;
    protected $fillable = [

        'pinjam_id',
        'buku_id',
        'tanggal_kembali',
        'denda',
        'keterangan',
    ];
    public function pinjams()
    {
        return $this->belongsTo(Pinjam::class, 'pinjam_id');
    }

    public function bukus()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
