<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_sempro extends Model
{
    use HasFactory;
    protected $table = 'nilai_sempros';
    protected $primaryKey = 'id_nilai';
    protected $guarded = ['id'];

    public function pengajuan()
    {
        return $this->belongsTo(pengajuan::class, 'id_pengajuan', 'id_tugasakhir');
    }

    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'id_dosen');
    }
}
