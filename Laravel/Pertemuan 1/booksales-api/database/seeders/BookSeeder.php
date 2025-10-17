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
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'description' => 'Buku pertama dari seri Harry Potter.', 'price' => 150000, 'stock' => 20, 'cover_photo' => 'https://placehold.co/400x600', 'author_id' => 1, 'genre_id' => 1],
            ['title' => 'Bumi', 'description' => 'Novel fiksi fantasi dari serial Bumi.', 'price' => 99000, 'stock' => 30, 'cover_photo' => 'https://placehold.co/400x600', 'author_id' => 2, 'genre_id' => 1],
            ['title' => 'Laskar Pelangi', 'description' => 'Kisah inspiratif tentang pendidikan di Belitung.', 'price' => 85000, 'stock' => 25, 'cover_photo' => 'https://placehold.co/400x600', 'author_id' => 3, 'genre_id' => 4],
            ['title' => 'Atomic Habits', 'description' => 'Cara mudah membangun kebiasaan baik.', 'price' => 125000, 'stock' => 50, 'cover_photo' => 'https://placehold.co/400x600', 'author_id' => 4, 'genre_id' => 3],
            ['title' => 'Sapiens: A Brief History of Humankind', 'description' => 'Ringkasan sejarah umat manusia.', 'price' => 250000, 'stock' => 15, 'cover_photo' => 'https://placehold.co/400x600', 'author_id' => 5, 'genre_id' => 5],
        ]);
    }
}
