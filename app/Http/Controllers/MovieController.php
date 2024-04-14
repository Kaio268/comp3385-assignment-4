<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; // Ensure you have a Movie model

class MovieController extends Controller
{
    /**
     * Fetch and return all movies from the database.
     */
    public function index()
    {
        $movies = Movie::all();

        return response()->json([
            'message' => 'Movies retrieved successfully',
            'movies' => $movies
        ]);
    }

    /**
     * Validate user input, handle the movie poster upload, and save movie info to the database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the poster file upload
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('public/posters');
            // Modify the path to a more accessible URL if necessary
            $validatedData['poster'] = asset(str_replace('public', 'storage', $path));
        }

        // Create and save the movie with the validated data
        $movie = Movie::create($validatedData);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201); // 201 status code for resource creation
    }
}
