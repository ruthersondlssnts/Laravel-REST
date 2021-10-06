<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\isAdmin;
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
    Route::post('login', [AuthController::class, 'login']);
   
   
    
   
    //Protected Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        //user
       // Route::patch('user/{id}/changePassword', [AuthController::class, 'changePassword']);
        Route::post('logout', [AuthController::class, 'logout']);
       

       
        Route::get('checkAuthentication',function ()
        {
            return response(["message"=>"Authenticated"],200);
        });
       
      
        //admin
        Route::group(['middleware' => ['is_admin']], function () {
            Route::post('register', [AuthController::class, 'register']);
            Route::patch('user/{id}/update', [AuthController::class, 'update']);
            Route::patch('user/{id}/adminChangePassword', [AuthController::class, 'adminChangePassword']);
            Route::resource('user', AuthController::class);
            Route::get('employee/getAllNotUser', [EmployeeController::class, 'getAllNotUser']);
            Route::resource('role', RoleController::class);
            Route::get('checkAdminAuthorization',function ()
            {
                return response(["message"=>"Authorized"],200);
            });
        });
        Route::group(['middleware' => ['is_admin_manager']], function () {
            Route::get('employee/', [EmployeeController::class, 'index']);
            Route::get('unit/getBranchEmployees/{id}', [UnitController::class, 'getBranchEmployees']);
            Route::get('unit/getBranches/{ascendants?}', [UnitController::class, 'getBranches']);
            Route::get('unit/', [UnitController::class, 'index']);
            Route::get('checkAdminManagerAuthorization',function ()
            {
                return response(["message"=>"Authorized"],200);
            });
        });
        Route::group(['middleware' => ['is_manager']], function () {
            //manager
            Route::get('employee/search/{name}', [EmployeeController::class, 'search']);
            Route::resource('employee', EmployeeController::class)->except(['index','show']);
            Route::resource('unit', UnitController::class)->except(['index']);
           
        });

       
        Route::get('employee/{id}', [EmployeeController::class, 'show']);
      
    });
});
