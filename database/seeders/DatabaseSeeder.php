<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan seeder yang telah dibuat
        $this->call([
            JenjangSeeder::class,
            ProdiSeeder::class,
        ]);
    }
}
