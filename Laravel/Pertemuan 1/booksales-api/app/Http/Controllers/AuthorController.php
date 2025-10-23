<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('authors', 'public');
            $validatedData['photo'] = $path;
        }

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
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }

            $path = $request->file('photo')->store('authors', 'public');
            $validatedData['photo'] = $path;
        }

        $author->update($validatedData);

        $author->load('books');
        return response()->json($author);
    }

    public function destroy(Author $author)
    {
        if ($author->photo) {
            Storage::disk('public')->delete($author->photo);
        }

        $author->delete();

        return response()->json(['message' => 'Author berhasil dihapus']);
    }
}