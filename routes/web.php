<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts',PostController::class);


Route::get('/clear', function () {
    Session::forget('user_posts');
    return "Sessions Cleared!";
});