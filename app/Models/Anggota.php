<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'alamat',
        'no_telepon',
        'status',
        'foto',
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategoris::class);
    }

    public function pinjams()
    {
        return $this->hasMany(Pinjam::class);
    }
}
