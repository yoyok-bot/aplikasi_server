<?php

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
    return view('dashboard');
});

Route::resource('/data_ram', 'RamController');
Route::resource('/data_hdd', 'HddController');
Route::resource('/data_rak', 'RakController');
Route::resource('/data_perangkat', 'PerangkatController');
Route::resource('/data_server', 'ServerController');
Route::resource('/data_vps', 'VpsController');
Route::resource('/data_aplikasi', 'DaftarAplikasiController');
Route::resource('/data_core', 'CoreController');
Route::resource('/', 'SemuaTabelController');
Route::get('tablerak','RakController@tablerak')->name('table.rak');
Route::delete('data_rak/{id}/delete','RakController@destroy');
Route::get('tableram','RamController@tableram')->name('table.ram');
Route::delete('data_ram/{id}/delete','RamController@destroy');
Route::get('tablehdd','HddController@tablehdd')->name('table.hdd');
Route::delete('data_hdd/{id}/delete','HddController@destroy');
Route::get('tableperangkat','PerangkatController@tableperangkat')->name('table.perangkat');
Route::delete('data_perangkat/{id}/delete','PerangkatController@destroy');
Route::get('tableserver','ServerController@tableserver')->name('table.server');
Route::delete('data_server/{id}/delete','ServerController@destroy');
Route::get('tablevps','VpsController@tablevps')->name('table.vps');
Route::delete('data_vps/{id}/delete','VpsController@destroy');
Route::get('tableaplikasi','DaftarAplikasiController@tableaplikasi')->name('table.aplikasi');
Route::delete('data_aplikasi/{id}/delete','DaftarAplikasiController@destroy');
Route::get('tableseluruh','SemuaTabelController@tableseluruh')->name('table.seluruh');
Route::get('tablecore','CoreController@tablecore')->name('table.core');
Route::delete('data_core/{id}/delete','CoreController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
