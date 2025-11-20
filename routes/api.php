<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\AuthController;

// Route::get('/ping', function () {
//     return response()->json(['message' => 'API aktif!']);
// });

Route::get('/health', fn() => response()->json(['status' => 'ok'])); 
Route::apiResource('todos', TodoController::class);

// Auth (tidak butuh token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Route terproteksi (butuh token)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('todos', TodoController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});