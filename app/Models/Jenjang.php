<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenjang';

    protected $table = 'jenjang';

    protected $fillable = [
        'nama_jenjang',
        'keterangan'
    ];

    // Jika jenjang berelasi dengan siswa

    }
