<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'tempat_pkl';

    // Primary key tabel
    protected $primaryKey = 'id_tempat_pkl';

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'kuota',
        'status',
    ];

    // Relasi dengan tabel lain jika diperlukan
    public function usulanPkls()
    {
        return $this->hasMany(UsulanPkl::class, 'id_tempat_pkl', 'id_tempat_pkl');
    }

    public function registrasi()
{
    return $this->hasMany(RegistrasiPkl::class, 'id_tempat_pkl','id_tempat_pkl'); // Sesuaikan nama foreign key
}
}
