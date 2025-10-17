<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['name' => 'Fantasi', 'description' => 'Genre yang melibatkan sihir dan dunia imajinatif.'],
            ['name' => 'Fiksi Ilmiah', 'description' => 'Genre berbasis spekulasi ilmiah dan teknologi masa depan.'],
            ['name' => 'Pengembangan Diri', 'description' => 'Genre yang bertujuan untuk meningkatkan kualitas diri pembaca.'],
            ['name' => 'Roman', 'description' => 'Genre yang berfokus pada kisah percintaan.'],
            ['name' => 'Sejarah', 'description' => 'Genre yang menceritakan peristiwa atau tokoh sejarah.'],
        ]);
    }
}
