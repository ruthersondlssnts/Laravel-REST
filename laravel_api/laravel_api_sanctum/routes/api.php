<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });







Route::group(['prefix' => '/v1'], function () {
    //Public Routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    //Protected Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        //user
        //admin
        //manager

        Route::get('employee/search/{name}', [EmployeeController::class, 'search']);
        Route::resource('employee', EmployeeController::class);
        Route::resource('role', RoleController::class);
        Route::get('unit/getBranchEmployees/{id}', [UnitController::class, 'getBranchEmployees']);
        Route::get('unit/getBranches/{ascendants}', [UnitController::class, 'getBranches']);
        Route::resource('unit', UnitController::class);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user/edit/{id}', [AuthController::class, 'edit']);
        Route::post('user/update/{id}', [AuthController::class, 'update']);
        Route::post('user/changePassword/{id}', [AuthController::class, 'changePassword']);
    });
});
