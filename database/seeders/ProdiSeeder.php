<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 data Prodi menggunakan factory
        Prodi::factory(10)->create();
    }
}
