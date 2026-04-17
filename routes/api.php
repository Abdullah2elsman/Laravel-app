<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('show/posts', [PostController::class, 'showPosts']);
    Route::get('show/posts/{id}', [PostController::class, 'showPost']);

    Route::post('store/posts', [PostController::class, 'storePost']);
});

Route::post('sanctum/login', [PostController::class,'sanctumLogin']);