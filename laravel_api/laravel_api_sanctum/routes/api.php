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





//Public Routes

//Protected Routes
Route::group(['prefix' => '/v1'], function () {
    // Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('employee/search/{name}', [EmployeeController::class, 'search']);
    Route::resource('employee', EmployeeController::class);
    Route::resource('role', RoleController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('auth', AuthController::class);
    // });
});
