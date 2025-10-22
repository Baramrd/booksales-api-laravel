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
            ['name' => 'J.K. Rowling', 'photo' => 'jkrowling.jpg', 'bio' => 'Penulis seri Harry Potter yang sangat terkenal di seluruh dunia.'],
            ['name' => 'Tere Liye', 'photo' => 'tereliye.jpg', 'bio' => 'Penulis produktif asal Indonesia dengan puluhan novel best-seller.'],
            ['name' => 'Andrea Hirata', 'photo' => 'andreahirata.jpg', 'bio' => 'Dikenal melalui novel Laskar Pelangi yang fenomenal.'],
            ['name' => 'James Clear', 'photo' => 'jamesclear.jpg', 'bio' => 'Pakar pembentukan kebiasaan, penulis buku Atomic Habits.'],
            ['name' => 'Yuval Noah Harari', 'photo' => 'yuvalnoahharari.jpg', 'bio' => 'Sejarawan dan penulis buku Sapiens, Homo Deus, dan 21 Lessons.'],
        ]);
    }
}
