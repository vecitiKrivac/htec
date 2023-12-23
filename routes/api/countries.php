<?php

use App\Http\Controllers\Api\CountryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'countries',
    'as' => 'countries'
], function () {
    Route::get('/', [CountryController::class, 'index'])->name('countries.name');
});
