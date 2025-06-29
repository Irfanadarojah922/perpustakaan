<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        // 'user_id',
        'verifikasi'
    ];

    protected $appends = [
        "foto_url"
    ];

    public function getFotoUrlAttribute()
    {
        return url(Storage::url("anggota/" . $this->foto));
    }

    protected $casts = [
        "tanggal_lahir" => "date:d/m/Y",
        "tanggal_daftar" => "date:d/m/Y",
        "verifikasi" => "boolean",
    ];


    // public function hasUser()
    // {
    //     return $this->hasOne(User::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
