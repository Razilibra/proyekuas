<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenjang;

class JenjangSeeder extends Seeder
{
    public function run()
    {
        // Data jenjang
        $jenjang = [
            ['jenjang' => 'D1'],
            ['jenjang' => 'D2'],
            ['jenjang' => 'D3'],
            ['jenjang' => 'D4'],
            ['jenjang' => 'S1'],
            ['jenjang' => 'S2'],
        ];

        foreach ($jenjang as $jenjangs) {
            Jenjang::create($jenjangs);
        }
    }
}
