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

use App\Http\Controllers\UserController2;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::apiResource('user', UserController2::class);


//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);


//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::apiResource('administrators', AdministratorController::class)
    ->except(['store']);

    Route::apiResource('illustrators', IllustratorController::class)
        ->except(['store']);
    Route::apiResource('socialMedias', SocialMediaController::class);
    Route::get('illustrators/{illustrator}/socialmedias', [IllustratorController::class, 'socialMedias']);

    Route::apiResource('schools', SchoolController::class)
        ->except(['store']);

    Route::apiResource('teachers', TeacherController::class)
        ->except(['store']);

    Route::apiResource('logs', LogController::class);

    Route::apiResource('redactions', RedactionController::class);
    Route::apiResource('tags', TagController::class);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::apiResource('administrators', AdministratorController::class)
    ->only(['store']);
Route::apiResource('illustrators', IllustratorController::class)
    ->only(['store']);
Route::apiResource('schools', SchoolController::class)
    ->only(['store']);
Route::apiResource('teachers', TeacherController::class)
    ->only(['store']);
