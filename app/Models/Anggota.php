<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telepon',
        'alamat',
        'tanggal_daftar',
        'status',
        'foto',
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategoris::class);
    }
}
