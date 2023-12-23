<?php

use App\Http\Controllers\Api\AirportController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'airports',
    'as' => 'airports',
    'middleware' => 'isAdmin'
], function () {
    Route::get('/', [AirportController::class, 'index'])->name('airports.index');
    Route::post('/', [AirportController::class, 'store'])->name('airports.store');
});
