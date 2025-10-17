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
            ['name' => 'J.K. Rowling', 'photo' => 'https://placehold.co/400x400', 'bio' => 'Penulis seri Harry Potter yang sangat terkenal di seluruh dunia.'],
            ['name' => 'Tere Liye', 'photo' => 'https://placehold.co/400x400', 'bio' => 'Penulis produktif asal Indonesia dengan puluhan novel best-seller.'],
            ['name' => 'Andrea Hirata', 'photo' => 'https://placehold.co/400x400', 'bio' => 'Dikenal melalui novel Laskar Pelangi yang fenomenal.'],
            ['name' => 'James Clear', 'photo' => 'https://placehold.co/400x400', 'bio' => 'Pakar pembentukan kebiasaan, penulis buku Atomic Habits.'],
            ['name' => 'Yuval Noah Harari', 'photo' => 'https://placehold.co/400x400', 'bio' => 'Sejarawan dan penulis buku Sapiens, Homo Deus, dan 21 Lessons.'],
        ]);
    }
}
