<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    require __DIR__ . '/api/cities.php';
    require __DIR__ . '/api/comments.php';
});


/*
Route::get('/cities', [App\Http\Controllers\Api\CityController::class, 'index']);
    Route::post('/comments', [App\Http\Controllers\Api\CommentController::class, 'store']);
    Route::put('/comments/{id}', [App\Http\Controllers\Api\CommentController::class, 'update']);
    Route::delete('/comments/{id}', [App\Http\Controllers\Api\CommentController::class, 'destroy']);
    Route::get('/flights', [App\Http\Controllers\Api\FlightController::class, 'index']);

    Route::group(['middleware' => ['isAdmin']], function () {
        Route::post('/cities', [App\Http\Controllers\Api\CityController::class, 'store']);
        Route::put('/cities/{id}', [App\Http\Controllers\Api\CityController::class, 'update']);
        Route::delete('/cities/{id}', [App\Http\Controllers\Api\CityController::class, 'destroy']);
        Route::get('/airports', [App\Http\Controllers\Api\AirportController::class, 'index']);
        Route::post('/airports', [App\Http\Controllers\Api\AirportController::class, 'store']);
        Route::post('/routes', [App\Http\Controllers\Api\RouteController::class, 'store']);
    });
*/