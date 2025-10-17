<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/posts', 'blog.index')->name('blog.index');
Route::view('/post/{slug}', 'blog.show')->name('posts.show');
Route::view('/posts/create', 'blog.create')->name('posts.create');
