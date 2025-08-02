<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;


    protected $table = 'ruangan';

    protected $fillable = ['kode_ruangan', 'nama_ruangan','keterangan'];


    public function sidang()
    {
        return $this->hasMany(Sidang::class, 'id_ruangan');
    }

}
