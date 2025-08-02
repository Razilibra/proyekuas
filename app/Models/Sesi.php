<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory; 

    // Nama tabel yang terkait dengan model ini
    protected $table = 'sesi';

    // Primary key untuk tabel
    protected $primaryKey = 'id_sesi';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode_sesi',
        'nama_sesi',
        'jam_mulai',
        'jam_berakhir',
        'keterangan',
    ];

    // Tipe data untuk atribut timestamp
    public $timestamps = true;

    // Jika primary key bukan integer, tambahkan ini (jika tidak perlu, abaikan)
    // public $incrementing = false;
    // protected $keyType = 'string';
}
