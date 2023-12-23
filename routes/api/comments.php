<?php

use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'comments',
    'as' => 'comments'
], function () {
    Route::get('/', [CommentController::class, 'index'])->name('comments.name');
});
