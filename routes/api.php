<?php

use Illuminate\Http\Request;

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
Route::post('login', 'AuthApiController@login');


Route::middleware('apilogin')->group(function () {
    Route::get('departments', 'DepartmentController@index');
    Route::get('departments/{department}', 'DepartmentController@show');
    Route::get('employees', 'EmployeeController@index');
    Route::post('update_bonus', 'EmployeeController@updateBonus');
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
