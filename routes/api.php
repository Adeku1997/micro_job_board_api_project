<?php

use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\LoginController;
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


//Public Routes
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/search/{title}', [JobController::class, 'search']);
Route::post('/jobs/{job}/application',[JobController::class,'apply']);

//Protected Routes
//Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/jobs', [JobController::class, 'create']);
    Route::put('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'delete']);

//});
