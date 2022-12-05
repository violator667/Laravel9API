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

Route::post('/auth/register', [App\Http\Controllers\API\AuthController::class, 'createUser']);
Route::post('/auth/login', [App\Http\Controllers\API\AuthController::class, 'loginUser']);

Route::resource('companies', 'App\Http\Controllers\API\CompanyController')->middleware('auth:sanctum');
Route::resource('employees', 'App\Http\Controllers\API\EmployeeController')->middleware('auth:sanctum');
