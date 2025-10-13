<?php

namespace App\Models;

class Genre
{
    public static function all()
    {
        return [
            ['id' => 1, 'name' => 'Fantasy', 'description' => 'Stories with magical elements and worlds.'],
            ['id' => 2, 'name' => 'Science Fiction', 'description' => 'Futuristic settings and advanced technology.'],
            ['id' => 3, 'name' => 'Romance', 'description' => 'Focuses on relationships and love stories.'],
            ['id' => 4, 'name' => 'Mystery', 'description' => 'Involves solving crimes or uncovering secrets.'],
            ['id' => 5, 'name' => 'Horror', 'description' => 'Intended to scare or unsettle readers.'],
        ];
    }
}
