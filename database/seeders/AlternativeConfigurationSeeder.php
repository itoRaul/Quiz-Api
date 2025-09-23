<?php

namespace Database\Seeders;

use App\Models\AlternativesConfiguration;
use Illuminate\Database\Seeder;

class AlternativeConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        AlternativesConfiguration::create([
            'name' => 'A',
            'color_name' => 'Azul',
            'color_hexadecimal' => '#4A90E2',
            'status' => true,
        ]);

        AlternativesConfiguration::create([
            'name' => 'B',
            'color_name' => 'Verde',
            'color_hexadecimal' => '#7ED321',
            'status' => true,
        ]);

        AlternativesConfiguration::create([
            'name' => 'C',
            'color_name' => 'Vermelho',
            'color_hexadecimal' => '#D0021B',
            'status' => true,
        ]);

        AlternativesConfiguration::create([
            'name' => 'D',
            'color_name' => 'Amarelo',
            'color_hexadecimal' => '#F5A623',
            'status' => true,
        ]);

    }
}
