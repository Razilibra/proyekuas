<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jurusan';

    protected $table = 'jurusan';

    protected $fillable = ['kode_jurusan','nama_jurusan','keterangan'];

    public function Jurusan()
    {
        return $this->hasmany(Mahasiswa::class, 'id');
    }
}

