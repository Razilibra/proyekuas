<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sempro extends Model
{
    use HasFactory;
    protected $table = 'sempros';
    protected $primaryKey = 'id_sempro';
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function pembimbing_1()
    {
        return $this->belongTo(dosen::class, 'pembimbing_1', 'id_dosen');
    }

    public function pembimbing_2()
    {
        return $this->belongsTo(dosen::class, 'pembimbing_2', 'id_dosen');
    }
    public function pengajuan()
    {
        return $this->belongsTo(pengajuan::class, 'id_pengajuan', 'id_tugasakhir');
    }

    public function penguji()
    {
        return $this->belongsTo(dosen::class, 'penguji_sempro', 'id_dosen');
    }

    public function ruangan()
    {
        return $this->belongsTo(ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function sesi()
    {
        return $this->belongsTo(sesi::class, 'id_sesi', 'id_sesi');
    }
}
