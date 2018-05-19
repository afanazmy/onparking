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

Route::get('students', 'StudentController@students');
Route::post('auth/student/register', 'AuthController@studentRegister');
Route::post('auth/operator/register', 'AuthController@operatorRegister');
Route::post('auth/login', 'AuthController@Login');

Route::get('users', 'UserController@users');

Route::get('student/profile', 'UserController@studentProfile')->middleware('auth:api');
Route::get('operator/profile', 'UserController@operatorProfile')->middleware('auth:api');

Route::put('student/profile/update/{student}', 'StudentController@update')->middleware('auth:api');
Route::put('operator/profile/update/{operator}', 'OperatorController@update')->middleware('auth:api');

Route::post('student/vehicle/add', 'VehicleController@add')->middleware('auth:api');
