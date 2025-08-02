<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanPkl extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'usulan_pkl';

    // Primary key
    protected $primaryKey = 'id_usulan_pkl';

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'id_mahasiswa',
        'id_tempat_pkl',
        'tahun_ajaran',
        'konfirmasi',
    ];

    /**
     * Relasi ke tabel mahasiswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    /**
     * Relasi ke tabel tempat_pkl.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tempatPkl()
    {
        return $this->belongsTo(TempatPkl::class, 'id_tempat_pkl', 'id_tempat_pkl');
    }
}
