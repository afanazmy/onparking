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

Route::get('users', 'UserController@users');
Route::get('students', 'StudentController@students');
Route::get('operators', 'OperatorController@operators');
Route::get('vehicles', 'VehicleController@vehicles');
Route::get('garages', 'GarageController@garages');
Route::get('parkings', 'ParkingController@parkings');

Route::post('auth/student/register', 'AuthController@studentRegister');
Route::post('auth/operator/register', 'AuthController@operatorRegister');
Route::post('auth/login', 'AuthController@Login');

Route::get('student/profile', 'UserController@studentProfile')->middleware('auth:api');
Route::get('operator/profile', 'UserController@operatorProfile')->middleware('auth:api');

Route::put('student/profile/update/{student}', 'StudentController@update')->middleware('auth:api');
Route::put('operator/profile/update/{operator}', 'OperatorController@update')->middleware('auth:api');

Route::post('student/vehicle/add', 'VehicleController@add')->middleware('auth:api');
Route::put('student/vehicle/update/{vehicle}', 'VehicleController@update')->middleware('auth:api');
Route::get('student/parking', 'ParkingController@student')->middleware('auth:api');

Route::post('operator/garage/add', 'GarageController@add')->middleware('auth:api');
Route::put('operator/garage/update/{garage}', 'GarageController@update')->middleware('auth:api');
Route::delete('operator/garage/delete/{garage}', 'GarageController@delete')->middleware('auth:api');

Route::post('operator/parking/add', 'ParkingController@add')->middleware('auth:api');
Route::put('operator/parking/update/{parking}', 'ParkingController@update')->middleware('auth:api');
Route::delete('operator/parking/delete/{parking}', 'ParkingController@delete')->middleware('auth:api');


Route::get('test', 'UserController@includeVehicle')->middleware('auth:api');
