<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::group(['middleware' => ['role:admin|company']], function () {
        Route::apiResource('company', CompanyController::class);
        Route::apiResource('employee', EmployeeController::class);
        Route::get('users', [UserController::class, 'index']);
        Route::post('me', [UserController::class, 'me']);
        Route::post('logout', [UserController::class, 'logout']);
        Route::post('giveRole', [UserController::class, 'giveRole']);
        Route::get('roles', [RoleController::class, 'index']);
    });
});
