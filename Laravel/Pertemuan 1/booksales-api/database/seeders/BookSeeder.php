<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            ['title' => 'Harry Potter', 'author_id' => 1, 'genre' => 'Fantasy', 'year' => 1997, 'price' => 150000],
            ['title' => 'Foundation', 'author_id' => 2, 'genre' => 'Sci-Fi', 'year' => 1951, 'price' => 120000],
            ['title' => 'Pride and Prejudice', 'author_id' => 3, 'genre' => 'Romance', 'year' => 1813, 'price' => 100000],
            ['title' => 'Murder on the Orient Express', 'author_id' => 4, 'genre' => 'Mystery', 'year' => 1934, 'price' => 130000],
            ['title' => 'The Shining', 'author_id' => 5, 'genre' => 'Horror', 'year' => 1977, 'price' => 140000],
        ]);
    }
}
