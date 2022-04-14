<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedactionController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\IllustratorController;

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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::apiResource('illustrators', IllustratorController::class)
        ->except(['store']);
    Route::apiResource('logs', LogController::class);
    Route::apiResource('redactions', RedactionController::class);
    Route::apiResource('schools', SchoolController::class)
        ->except(['store']);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('teachers', TeacherController::class);

    // Administration routes
    Route::post('create-user', [UserController::class, 'createUser']);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::apiResource('illustrators', IllustratorController::class)
    ->only(['store']);
Route::post('schools', [SchoolController::class, 'store']);
