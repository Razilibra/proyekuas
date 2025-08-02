<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPkl extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'mahasiswa_pkl';

    // Primary key
    protected $primaryKey = 'id_mahasiswa_pkl';

    // Kolom yang dapat diisi
    protected $guarded= ['id_mahasiswa_pkl'];

    // Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    // Relasi ke tabel TempatPkl
    public function tempatPkl()
    {
        return $this->belongsTo(TempatPkl::class, 'id_tempat_pkl', 'id_tempat_pkl');
    }
    public function nilai()

    {
        return $this->belongsTo(PenilaianSidang::class, 'id_penilaian_sidang');
    }
    // Relasi ke tabel Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
    public function dosenpenguji()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji', 'id_dosen');
    }

    // public function dosenPembimbing()
    // {
    //     return $this->belongsTo(Dosen::class, 'dosen_pembimbing');
    // }


    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi');
    }
    public function registrasi()
    {
        return $this->belongsTo(Registrasipkl::class, 'id_registrasi_pkl','id_registrasi_pkl');
    }

    public function NilaiPKL()
    {
        return $this->belongsTo(Nilaipkl::class, 'id_nilai_pkl', 'id_nilai_pkl');
    }





}

