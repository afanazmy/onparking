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

Route::get('mahasiswas', 'MahasiswaController@mahasiswas');
Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::post('login', 'AuthController@login');
Route::get('mahasiswas/profil', 'MahasiswaController@profil')->middleware('auth:api');
Route::post('kendaraan', 'KendaraanController@tambah')->middleware('auth:api');
