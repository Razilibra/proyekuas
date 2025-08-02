<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tugasakhir';
    protected $table = 'pengajuans';
    protected $guarded =['id'];

    public function mahasiswapengajuan(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }

    public function bidangpengajuan(){
        return $this->belongsTo(Bidang::class,'bidang_id','id_bidang');
    }

    public function pembimbing1(){
        return $this->belongsTo(Dosen::class,'pembimbing_1','id_dosen');
    }

    public function pembimbing2(){
        return $this->belongsTo(Dosen::class,'pembimbing_2','id_dosen');
    }

    public function bimbingan(){
        return $this->hasMany(Bimbingan::class, 'id');
    }
}
