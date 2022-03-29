<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedactionController;

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

Route::apiResource('redactions', RedactionController::class);
Route::apiResource('tags', RedactionController::class);
Route::apiResource('teachers', RedactionController::class);
Route::apiResource('schools', RedactionController::class);
Route::apiResource('logs', RedactionController::class);
Route::apiResource('ilustrators', RedactionController::class);
Route::apiResource('uses', RedactionController::class);
Route::apiResource('administrators', RedactionController::class);
Route::apiResource('socialMedias', RedactionController::class);

Route::get('teste', RedactionController::class);
