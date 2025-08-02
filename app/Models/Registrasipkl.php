<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiPkl extends Model
{
    use HasFactory;

    protected $table = 'registrasi_pkl';

    protected $primaryKey = 'id_registrasi_pkl';

    public $timestamps = false;

    protected $fillable = [
        'id_mahasiswa',
        'id_tempat_pkl',
        'alamat_perusahaan',
        'file',
        'pembimbing_id',
        'konfirmasi',
    ];

    // Define relationships
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }


    public function pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_id', 'id_dosen');
    }

      public function tempatPkl()
    {
        return $this->belongsTo(TempatPkl::class, 'id_tempat_pkl', 'id_tempat_pkl');
    }
}
