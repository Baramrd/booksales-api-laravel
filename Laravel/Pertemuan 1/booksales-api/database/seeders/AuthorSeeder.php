<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            ['name' => 'J.K. Rowling', 'nationality' => 'British'],
            ['name' => 'Isaac Asimov', 'nationality' => 'Russian-American'],
            ['name' => 'Jane Austen', 'nationality' => 'British'],
            ['name' => 'Agatha Christie', 'nationality' => 'British'],
            ['name' => 'Stephen King', 'nationality' => 'American'],
        ]);
    }
}
