<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    private const BOOK_STORAGE_DIR = 'books/';

    private function getStoragePath(string $coverPhoto): string
    {
        if (Str::startsWith($coverPhoto, self::BOOK_STORAGE_DIR)) {
            return $coverPhoto;
        }
        return self::BOOK_STORAGE_DIR . $coverPhoto;
    }

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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'author_id' => 'required|integer|exists:authors,id',
            'genre_id' => 'required|integer|exists:genres,id',
        ]);

        if ($request->hasFile('cover_photo')) {
            $path = $request->file('cover_photo')->store(self::BOOK_STORAGE_DIR, 'public'); 
            $validatedData['cover_photo'] = $path;
        }

        $book = Book::create($validatedData);
        $book->load(['author', 'genre']);

        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        $book->load(['author', 'genre']);
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'cover_photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'author_id' => 'sometimes|integer|exists:authors,id',
            'genre_id' => 'sometimes|integer|exists:genres,id',
        ]);

        if ($request->hasFile('cover_photo')) {
            if ($book->cover_photo) {
                Storage::disk('public')->delete($this->getStoragePath($book->cover_photo));
            }
            $path = $request->file('cover_photo')->store(self::BOOK_STORAGE_DIR, 'public');
            $validatedData['cover_photo'] = $path;
        }

        $book->update($validatedData);
        $book->load(['author', 'genre']);

        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        if ($book->cover_photo) {
            Storage::disk('public')->delete($this->getStoragePath($book->cover_photo));
        }
        $book->delete();
        
        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}