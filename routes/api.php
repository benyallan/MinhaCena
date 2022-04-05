<?php

use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedactionController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\IllustratorController;
use App\Http\Controllers\AdministratorController;

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


//Route::apiResource('users', RedactionController::class);

Route::apiResource('administrators', AdministratorController::class);
Route::apiResource('illustrators', IllustratorController::class);
Route::get('illustrators/{illustrator}/socialmedias', [IllustratorController::class, 'socialMedias']);
Route::apiResource('logs', LogController::class);
Route::apiResource('redactions', RedactionController::class);
Route::apiResource('schools', SchoolController::class);
Route::apiResource('socialMedias', SocialMediaController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('teachers', TeacherController::class);



