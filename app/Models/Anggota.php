<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'alamat',
        'no_telepon',
        'status',
        'foto',
        'tanggal_daftar',
    ];

    protected $cast = [
        "tanggal_lahir" => "date:d/m/Y",
        "tanggal_daftar" => "date:d/m/Y"
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
