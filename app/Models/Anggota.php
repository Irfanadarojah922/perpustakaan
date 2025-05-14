<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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

    public function pinjams()
    {
        return $this->hasMany(Pinjam::class);
    }

    public function hasUser()
    {
        return $this->hasOne(User::class);
    }
}
