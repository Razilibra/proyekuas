<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPklLogBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mahasiswa_pkl_log_book';
    protected $table = 'mahasiswa_pkl_log_book';
    protected $guarded = [
        'id',
    ];

    // Relasi dengan Mahasiswa PKL
    public function Registrasipkl()
    {
        return $this->belongsTo(Registrasipkl::class, 'id_registrasi_pkl');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
    

    
}
