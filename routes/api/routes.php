<?php

use App\Http\Controllers\Api\RouteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'routes',
    'as' => 'routes',
    'middleware' => 'isAdmin'
], function () {
    Route::post('/', [RouteController::class, 'store'])->name('routes.store');
});
