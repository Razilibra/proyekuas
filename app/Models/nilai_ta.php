<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_ta extends Model
{
    use HasFactory;
    protected $table = 'nilai_tas';
    protected $primaryKey = 'id_nilai_ta';
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
