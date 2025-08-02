<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Nama tabel di database
    protected $primaryKey = 'id_mahasiswa'; // Primary key tabel
    protected $fillable = [
        'nim',
        'nama',
        'id_prodi',
        'id_jurusan',
        'gender',
        'password',
        'foto',
        'tanggal_daftar',
        'akses',
    ];

    // Relasi ke tabel prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relasi ke tabel jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
