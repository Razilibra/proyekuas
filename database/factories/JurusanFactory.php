<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Jurusan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_jurusan' => 'TI',
            'nama_jurusan' => 'Teknologi Informasi',
            'keterangan'   => 'Jurusan TI dengan bentuk terbaik',
        ];
    }
}
