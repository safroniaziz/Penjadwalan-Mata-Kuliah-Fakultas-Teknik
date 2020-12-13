<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/','FrontController@index')->name('front');
// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'operator'], function () {
    Auth::routes();
    Route::get('/dashboard','DashboardOperatorController@dashboard')->name('operator.dashboard');
});

Route::group(['prefix' => 'data_dosen'], function () {
    Route::get('/','DosenController@index')->name('operator.dosen');
    Route::post('/tambah','DosenController@post')->name('operator.dosen.post');
});

Route::group(['prefix' => 'manajemen_ruangan'], function () {
    Route::get('/','RuanganController@index')->name('operator.ruangan');
    Route::post('/tambah','RuanganController@post')->name('operator.ruangan.post');
    Route::delete('/hapus','RuanganController@delete')->name('operator.ruangan.delete');
});

Route::group(['prefix' => 'mata_kuliah'], function () {
    Route::get('/','MatkulController@index')->name('operator.matkul');
    Route::post('/tambah','MatkulController@post')->name('operator.matkul.post');
    Route::delete('/hapus','MatkulController@delete')->name('operator.matkul.delete');
});

Route::group(['prefix' => 'mata_kuliah'], function () {
    Route::get('/','MatkulController@index')->name('operator.matkul');
    Route::post('/tambah','MatkulController@post')->name('operator.matkul.post');
});

Route::group(['prefix' => 'jadwal_perkuliahan'], function () {
    Route::get('/','JadwalController@index')->name('operator.jadwal');
    Route::get('/cari_jadwal','JadwalController@cariJadwal')->name('operator.cari_jadwal');
    Route::get('/ubah_jadwal/{id}','JadwalController@ubahJadwal')->name('operator.ubah_jadwal');
    Route::patch('/ubah_jadwal/{id_dari}/{id}','JadwalController@ubahJadwalPost')->name('operator.ubah_jadwal.post');
    Route::post('/','JadwalController@generateJadwal')->name('operator.generate_jadwal');
});

Route::group(['prefix' => 'matkul_tanpa_jadwal'], function () {
    Route::get('/','TanpaJadwalController@index')->name('operator.tanpa_jadwal');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
