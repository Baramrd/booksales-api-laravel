<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genre'])->get();
        
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_photo' => 'required|string|max:255',
            'author_id' => 'required|integer|exists:authors,id',
            'genre_id' => 'required|integer|exists:genres,id',
        ]);

        $book = Book::create($validatedData);

        $book->load(['author', 'genre']);

        return response()->json($book, 201);
    }
}