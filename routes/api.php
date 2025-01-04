<?php

// Custom Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PupilController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\CellAssignmentController;

use Illuminate\Support\Facades\Route;

// Define your API routes here
Route::middleware('api')->group(function () {
	Route::post('/login', [UserController::class, 'login']);
	Route::post('/register', [App\Http\Controllers\UserController::class, 'store']); 
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('schools', App\Http\Controllers\SchoolController::class);
    Route::apiResource('headers', App\Http\Controllers\HeaderController::class);
	Route::apiResource('users', App\Http\Controllers\UserController::class);
	Route::apiResource('classes', SchoolClassController::class)
     ->parameters([
         'classes' => 'schoolClass'
     ]);

	 Route::apiResource('subjects', SubjectController::class);
	 Route::apiResource('pupils', PupilController::class);
	 Route::get('/classes/{classId}/pupils', [SchoolClassController::class, 'getPupilsByClass']);


	 Route::post('/cell-assignments', [CellAssignmentController::class, 'store']);
	Route::get('/cell-assignments', [CellAssignmentController::class, 'index']);
});