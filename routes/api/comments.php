<?php

use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'comments',
    'as' => 'comments'
], function () {
    Route::post('/', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/{id}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
