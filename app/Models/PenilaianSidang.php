<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidang extends Model
{
    use HasFactory;

    protected $table = 'penilaian_sidang';
    protected $primaryKey = 'id_penilaian_sidang';
    protected $guarded= [
        'id'
    ];

    public function mahasiswaPkl()
    {
        return $this->belongsTo(MahasiswaPkl::class, 'id_mahasiswa_pkl');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
