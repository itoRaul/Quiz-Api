<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativeConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatives_configuration')->truncate();

        DB::table('alternatives_configuration')->insert([
            [
                'name' => 'A',
                'color_name' => 'Azul',
                'color_hexadecimal' => '#4A90E2',
                'status' => 'true',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B',
                'color_name' => 'Verde',
                'color_hexadecimal' => '#7ED321',
                'status' => 'true',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'C',
                'color_name' => 'Vermelho',
                'color_hexadecimal' => '#D0021B',
                'status' => 'true',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'D',
                'color_name' => 'Amarelo',
                'color_hexadecimal' => '#F5A623',
                'status' => 'true',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
