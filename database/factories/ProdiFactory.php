<?php

namespace Database\Factories;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Jenjang;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdiFactory extends Factory
{
    protected $model = Prodi::class;

    public function definition()
    {
        return [
            'id_jurusan' => Jurusan::inRandomOrder()->first()->id_jurusan,  // Mengambil id jurusan secara acak
            'nama_prodi' => $this->faker->word,
            'id_jenjang' => Jenjang::inRandomOrder()->first()->id_jenjang,  // Mengambil id jenjang secara acak
        ];
    }
}
