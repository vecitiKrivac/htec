<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
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
    require __DIR__ . '/api/countries.php';
    require __DIR__ . '/api/cities.php';
    require __DIR__ . '/api/airports.php';
    require __DIR__ . '/api/routes.php';
    require __DIR__ . '/api/comments.php';
});
