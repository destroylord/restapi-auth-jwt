<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($router) {
    Route::post('/login', [ AuthController::class, 'login']);
    Route::post('/register', [ AuthController::class, 'register']);
    Route::post('/logout', [ AuthController::class, 'logout']);
    Route::post('/refresh', [ AuthController::class, 'refresh']);
    Route::get('/me', [ AuthController::class, 'me']);
});
