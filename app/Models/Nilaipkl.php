<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilaipkl extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'nilai_pkl';

    // Primary key tabel
    protected $primaryKey = 'id_nilai_pkl';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_dosen',
        'id_mahasiswa_pkl',
        'keaktifan_bimbingan',
        'komunikatif',
        'problem_solving',
        'total_nilai',
        'keterangan',
    ];

    // Relasi dengan tabel dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    // Relasi dengan tabel mahasiswa_pkl
    public function mahasiswaPkl()
    {
        return $this->belongsTo(MahasiswaPkl::class, 'id_mahasiswa_pkl', 'id_mahasiswa_pkl');
    }
}
