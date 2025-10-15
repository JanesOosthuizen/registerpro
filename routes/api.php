<?php

// Custom Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\PupilController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\CellAssignmentController;
use App\Http\Controllers\CellPlanningController;
use App\Http\Controllers\ToolsController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Define your API routes here
Route::middleware('api')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\UserController::class, 'store']);
    Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
});

Route::get('/', function (Request $request) {
    return response()->json([
        'message' => 'API is running',
        'version' => '1.0',  // Or pull from config
        'timestamp' => now(),
    ]);
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
    Route::delete('/cell-assignments/{row}-{column}', [CellAssignmentController::class, 'destroy']);

    Route::get('/planning', [CellPlanningController::class, 'getUserPlannings']);
    Route::get('/planning/{cellKey}', [CellPlanningController::class, 'index']);
    Route::get('/planning/id/{id}', [CellPlanningController::class, 'getById']);
    Route::post('/planning', [CellPlanningController::class, 'storeNoCell']);
    Route::post('/planning/{cellKey}', [CellPlanningController::class, 'store']);
    Route::put('/planning/{id}', [CellPlanningController::class, 'update']);
    Route::delete('/planning/{id}', [CellPlanningController::class, 'destroy']);

    Route::get('/planning/{id}/notes', [CellPlanningController::class, 'getNotes']);
    Route::post('/planning/{id}/notes', [CellPlanningController::class, 'addNote']);
    Route::put('/notes/{id}', [CellPlanningController::class, 'updateNote']);
    Route::delete('/notes/{id}', [CellPlanningController::class, 'deleteNote']);

    Route::post('/export-register', [ToolsController::class, 'exportRegister']);
});

