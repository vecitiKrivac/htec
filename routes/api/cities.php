<?php

use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cities',
    'as' => 'cities'
], function () {
    Route::get('/', [CityController::class, 'index'])->name('cities.name');

    Route::group(['middleware' => ['isAdmin']], function () {
        Route::post('/', [CityController::class, 'store'])->name('cities.store');
        Route::put('/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('/{id}', [CityController::class, 'destroy'])->name('cities.destroy');
    });
});
