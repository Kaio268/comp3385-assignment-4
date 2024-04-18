<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; // Ensure you have a Movie model
use Illuminate\Support\Facades\Log; // Import the Log facade

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
        // Log the incoming request data for debugging
        Log::info('Request Data:', $request->all());

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'poster' => 'required|image|max:12288',
        ]);

        // Handle the poster file upload
        if ($request->hasFile('poster')) {
            // Storing the file with its original name in 'public/posters'
            $path = $request->file('poster')->storeAs('public/posters', $request->file('poster')->getClientOriginalName());
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

