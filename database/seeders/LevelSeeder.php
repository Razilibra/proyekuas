<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data level statis
        $levels = ['Administrator', 'Kaprodi', 'Dosen', 'Mahasiswa', 'SuperAdmin', 'Kajur'];

        foreach ($levels as $level) {
            Level::create([
                'level' => $level,
            ]);
        }

        // Atau dengan factory (jika ingin random data)
        // Level::factory()->count(10)->create();
    }
}
