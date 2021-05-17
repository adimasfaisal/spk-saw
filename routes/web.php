<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'KasusController@index')->name('dashboard');
Route::get('/kasus-baru', 'KasusController@create')->name('kasus-baru');
Route::get('/tambah-kasus', 'KasusController@store')->name('tambah-kasus');
Route::get('/kasus/{id}', 'KasusController@detail')->name('detail-kasus');
Route::get('/kasus/tambah-alternatif/{id}', 'AlternatifController@store')->name('tambah-alternatif');
Route::get('/kasus/tambah-alternatif/{id}/nilai', 'NilaiController@store')->name('tambah-nilai');
Route::get('/kasus/{id}/hitung', 'NilaiController@hitung')->name('hitung');