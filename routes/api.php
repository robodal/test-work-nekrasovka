<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RubricController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    // Get token auth route
    Route::post('/auth', [UserController::class, 'auth']);

    // Public methods
    Route::post('/users/{userId}/subscribe/{rubricId}', [UserController::class, 'subscribe']);
    Route::post('/users/{userId}/unsubscribe/{rubricId}', [UserController::class, 'unsubscribe']);
    Route::post('/users/{userId}/forget', [UserController::class, 'forget']);

    // Protected methods
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/users/{userId}/rubrics', [UserController::class, 'rubricsList']);
        Route::get('/rubrics/{rubricId}/users', [RubricController::class, 'usersList']);
    });

});

