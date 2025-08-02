<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bidang extends Model
{
    use HasFactory;
    protected $table = 'bidangs';
    protected $primaryKey = 'id_bidang';
    protected $fillable = [
        'bidang',
    ];
    public function dosens()
{
    return $this->hasMany(Dosen::class, 'id_bidang');
}
    
}

