<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;

    protected $table = 'golongan'; // Nama tabel
    protected $primaryKey = 'id_golongan'; // Primary key tabel
    protected $fillable = ['nama_golongan']; // Kolom yang dapat diisi
}
