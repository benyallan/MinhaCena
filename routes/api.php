<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('redactions', App\Http\Controllers\RedactionController::class);
Route::apiResource('tags', App\Http\Controllers\RedactionController::class);
Route::apiResource('teachers', App\Http\Controllers\RedactionController::class);
Route::apiResource('schools', App\Http\Controllers\RedactionController::class);
Route::apiResource('logs', App\Http\Controllers\RedactionController::class);
Route::apiResource('ilustrators', App\Http\Controllers\RedactionController::class);
Route::apiResource('uses', App\Http\Controllers\RedactionController::class);
Route::apiResource('administrators', App\Http\Controllers\RedactionController::class);
Route::apiResource('socialMedias', App\Http\Controllers\RedactionController::class);

Route::get('teste', RedactionController::class);
