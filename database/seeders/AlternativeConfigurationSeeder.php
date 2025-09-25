<?php

namespace Database\Seeders;

use App\Models\AlternativeConfiguration;
use Illuminate\Database\Seeder;

class AlternativeConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        AlternativeConfiguration::create([
            'name' => 'A',
            'color_name' => 'Azul',
            'color_hexadecimal' => '#4A90E2',
            'status' => true,
        ]);

        AlternativeConfiguration::create([
            'name' => 'B',
            'color_name' => 'Verde',
            'color_hexadecimal' => '#7ED321',
            'status' => true,
        ]);

        AlternativeConfiguration::create([
            'name' => 'C',
            'color_name' => 'Vermelho',
            'color_hexadecimal' => '#D0021B',
            'status' => true,
        ]);

        AlternativeConfiguration::create([
            'name' => 'D',
            'color_name' => 'Amarelo',
            'color_hexadecimal' => '#F5A623',
            'status' => true,
        ]);

    }
}
