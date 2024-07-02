<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/auth')->group(function (){
    Route::post('login' , [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout' , [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function (){
    Route::post('forms' , [\App\Http\Controllers\FormController::class, 'store']);
    Route::get('forms' , [\App\Http\Controllers\FormController::class, 'index']);
    Route::get('forms/{slug}' , [\App\Http\Controllers\FormController::class, 'show']);
    Route::post('forms/{slug}/questions' , [\App\Http\Controllers\QuestionController::class, 'addQuestion']);
    Route::delete('forms/{slug}/questions/{id}' , [\App\Http\Controllers\QuestionController::class, 'removeQuestion']);
    Route::get('forms/{slug}/responses' , [\App\Http\Controllers\ResponseController::class, 'index']);
    Route::post('forms/{slug}/responses' , [\App\Http\Controllers\ResponseController::class, 'store']);
});

