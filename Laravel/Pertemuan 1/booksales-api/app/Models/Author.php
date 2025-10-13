<?php

namespace App\Models;

class Author
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'J.K. Rowling', 'nationality' => 'British'],
            ['id' => 2, 'name' => 'Isaac Asimov', 'nationality' => 'Russian-American'],
            ['id' => 3, 'name' => 'Jane Austen', 'nationality' => 'British'],
            ['id' => 4, 'name' => 'Agatha Christie', 'nationality' => 'British'],
            ['id' => 5, 'name' => 'Stephen King', 'nationality' => 'American'],
        ];
    }
}
