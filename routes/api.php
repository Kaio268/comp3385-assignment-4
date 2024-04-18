    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MovieController;
    use App\Http\Controllers\AuthController;

    // Route for retrieving the authenticated user's details using Sanctum for security
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    // Route to fetch all movies - accesses the 'index' method in MovieController
    // Ensure this is the only GET route for '/v1/movies'
    Route::get('/v1/movies', [MovieController::class, 'index'])
        ->middleware('auth:api') // Secures the index route with JWT
        ->name('movies.index');

    // Route to create a new movie entry - connects to the 'store' method in MovieController
    // Ensure this is the only POST route for '/v1/movies'
    Route::post('/v1/movies', [MovieController::class, 'store'])
        ->middleware('auth:api') // Secures the store route with JWT
        ->name('movies.store');

    // Route for user login
    Route::post('/v1/login', [AuthController::class, 'login']);

    // Optionally, add route for user logout
    Route::post('/v1/logout', [AuthController::class, 'logout'])
        ->middleware('auth:api'); // Secures the logout route with JWT
