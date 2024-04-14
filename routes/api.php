<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Route for retrieving the authenticated user's details using Sanctum for security
Route::get('/user', function (Request $request) {
    // Leveraging Sanctum for secure user authentication
    return $request->user();
})->middleware('auth:sanctum');

// Route to fetch all movies - accesses the 'index' method in MovieController
Route::get('/v1/movies', [MovieController::class, 'index'])->name('movies.index');

// Route to create a new movie entry - connects to the 'store' method in MovieController
Route::post('/v1/movies', [MovieController::class, 'store'])->name('movies.store');
