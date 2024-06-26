<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/auth')->group(function(){
     Route::post('login' , [\App\Http\Controllers\AuthController::class, 'login']);
     Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
     Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    Route::post('posts' , [\App\Http\Controllers\PostController::class, 'store']);
    Route::delete('posts/{id}' , [\App\Http\Controllers\PostController::class, 'deleted']);
    Route::get('posts' , [\App\Http\Controllers\PostController::class, 'index']);


    //user
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('users/{username}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::get('/use/profile', [\App\Http\Controllers\UserController::class, 'user']);


    Route::post('users/{username}/follow' , [\App\Http\Controllers\FollowingController::class, 'follow']);

});

