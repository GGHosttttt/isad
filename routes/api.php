<?php

use App\Http\Controllers\Api\V1\approveBookController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\BookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('/tasks', TaskController::class);

    Route::put('/tasks/{task}', [TaskController::class, 'update']);  // OR
    // Route::patch('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks', [TaskController::class, 'destroyAll']);


    Route::apiResource('/books', BookController::class);
    Route::put('/books/{book}', [BookController::class, 'update']);  // OR
    Route::delete('/books', [BookController::class, 'destroyAll']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
