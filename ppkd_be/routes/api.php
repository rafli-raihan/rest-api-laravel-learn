<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json('API sudah bisa digunakan');
});

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', [\App\Http\Controllers\API\LoginController::class, 'me'])->name('me')->middleware('auth: sanctum');
    Route::apiResource('user', \App\Http\Controllers\API\UserController::class);
});

// dimasukin ke middleware route2 yang cuma bisa diakses kalo udah login
