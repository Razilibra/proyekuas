<?php

namespace App\Models;

use App\Http\Controllers\MahasiswaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prodi';

    protected $table = 'prodi'; // Specify the table name if it's not the plural form
    protected $fillable = ['nama_prodi', 'id_jurusan', 'id_jenjang'];

    public function Prodi()
    {
        return $this->hasmany(Mahasiswa::class, 'id');
    }
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
