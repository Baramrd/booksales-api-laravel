<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        
        return response()->json($authors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'bio' => 'required|string',
        ]);

        $author = Author::create($validatedData);

        return response()->json($author, 201);
    }

    public function show(Author $author)
    {
        $author->load('books');
        return response()->json($author);
    }

    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|string|max:255',
            'bio' => 'required|string',
        ]);

        $author->update($validatedData);

        $author->load('books');
        return response()->json($author);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json(['message' => 'Author berhasil dihapus']);
    }
}