<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/auth')->group(function () {
    Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);
    Route::post('signin', [\App\Http\Controllers\AuthController::class, 'signin']);
    Route::post('signout', [\App\Http\Controllers\AuthController::class, 'signout'])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum', 'admin'])->prefix('v1')->group(function(){
    Route::get('admins', [\App\Http\Controllers\AdminController::class, 'index']);
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('users/{username}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store']);
    Route::put('users/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
});
Route::middleware('auth:sanctum')->prefix('v1')->group(function(){

    Route::get('games', [\App\Http\Controllers\GameController::class, 'index']);
    Route::post('games', [\App\Http\Controllers\GameController::class, 'store']);
    Route::put('games/{slug}', [\App\Http\Controllers\GameSlugController::class, 'update']);
    Route::delete('games/{slug}', [\App\Http\Controllers\GameSlugController::class, 'destroy']);
});
