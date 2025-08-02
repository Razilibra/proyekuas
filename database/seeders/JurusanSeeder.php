<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data statis
        $jurusans = [
            ['kode_jurusan' => 'TI', 'nama_jurusan' => 'Teknologi Informasi', 'keterangan' => 'Jurusan TI dengan bentuk terbaik'],
            ['kode_jurusan' => 'TM', 'nama_jurusan' => 'Teknik Mesin', 'keterangan' => 'Jurusan Teknik Mesin unggul dalam praktik'],
            ['kode_jurusan' => 'TS', 'nama_jurusan' => 'Teknik Sipil', 'keterangan' => 'Jurusan Teknik Sipil yang maju'],
            ['kode_jurusan' => 'TE', 'nama_jurusan' => 'Teknik Elektro', 'keterangan' => 'Jurusan Teknik Elektro berbasis teknologi'],
            ['kode_jurusan' => 'AN', 'nama_jurusan' => 'Administrasi Niaga', 'keterangan' => 'Jurusan Administrasi Niaga yang kompeten'],
            ['kode_jurusan' => 'BI', 'nama_jurusan' => 'Bahasa Inggris', 'keterangan' => 'Jurusan Bahasa Inggris dengan program unggulan'],
            ['kode_jurusan' => 'AK', 'nama_jurusan' => 'Akuntansi', 'keterangan' => 'Jurusan Akuntansi terbaik dalam bidangnya'],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
