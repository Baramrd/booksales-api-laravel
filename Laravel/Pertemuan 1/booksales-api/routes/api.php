<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;

// Rute Publik untuk Autentikasi (Register & Login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Publik untuk Author dan Genre (Read All & Show)
Route::apiResource('authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('genres', GenreController::class)->only(['index', 'show']);

// Rute Buku
Route::get('/books', [BookController::class, 'index']);

// Rute Admin yang Dilindungi
Route::middleware(['auth:api', 'admin'])->group(function () {
    // Menggunakan except() untuk melindungi rute Create, Update, Destroy
    Route::apiResource('authors', AuthorController::class)->except(['index', 'show']);
    Route::apiResource('genres', GenreController::class)->except(['index', 'show']);
    
    // Route::apiResource('books', BookController::class); 
});