<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPkl extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan_pkl';

    protected $table = 'laporan_pkl';

    protected $fillable = [
        'nobp',
        'nama',
        'prodi',
        'nama_perusahaan',
        'alamat',
        'file',
        'tahun_ajaran'
    ];
}
