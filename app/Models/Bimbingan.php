<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bimbingan extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function bimbingandosen()
    {
        return $this->belongsTo(dosen::class, 'dosen_id');
    }
    public function bimbinganmahasiswa()
    {
        return $this->belongsTo(mahasiswa::class, 'mahasiswa_id', 'id');
    }
}

