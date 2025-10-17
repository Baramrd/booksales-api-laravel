<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('books')->get();

        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:genres|max:255',
            'description' => 'required|string',
        ]);

        $genre = Genre::create($validatedData);

        return response()->json($genre, 201);
    }
}