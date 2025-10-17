<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

//Route::apiResource('posts', PostController::class);
//
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('api.posts.show');
