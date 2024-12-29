<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Define your API routes here

Route::middleware('api')->group(function () {
	Route::post('/login', [UserController::class, 'login']);
    Route::apiResource('schools', App\Http\Controllers\SchoolController::class);
    Route::apiResource('users', App\Http\Controllers\UserController::class);
});