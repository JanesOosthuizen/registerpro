<?php

// Custom Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PupilController;

use Illuminate\Support\Facades\Route;

// Define your API routes here

Route::middleware('api')->group(function () {
	Route::post('/login', [UserController::class, 'login']);
    Route::apiResource('schools', App\Http\Controllers\SchoolController::class);
    Route::apiResource('users', App\Http\Controllers\UserController::class);
	Route::apiResource('classes', SchoolClassController::class)
     ->parameters([
         'classes' => 'schoolClass'
     ]);

	 Route::apiResource('subjects', SubjectController::class);
	 Route::apiResource('pupils', PupilController::class);
});