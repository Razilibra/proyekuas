<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;

    protected $table = 'sidang';

    protected $fillable = ['tanggal', 'id_sesi', 'id_ruangan'];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
