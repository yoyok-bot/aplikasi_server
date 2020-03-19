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
Route::resource('/data_aplikasi', 'DaftarAplikasiController');
Route::resource('/data_core', 'CoreController');
Route::resource('/data_grafik', 'GrafikController');
Route::resource('/', 'SemuaTabelController');
Route::get('tablerak','RakController@tablerak')->name('table.rak');
Route::delete('data_rak/{id}/delete','RakController@destroy');
Route::get('tableram','RamController@tableram')->name('table.ram');
Route::delete('data_ram/{id}/delete','RamController@destroy');
Route::get('tablehdd','HddController@tablehdd')->name('table.hdd');
Route::delete('data_hdd/{id}/delete','HddController@destroy');
Route::get('tableperangkat','PerangkatController@tableperangkat')->name('table.perangkat');
Route::delete('data_perangkat/{id}/delete','PerangkatController@destroy');
Route::get('tableaplikasi','DaftarAplikasiController@tableaplikasi')->name('table.aplikasi');
Route::delete('data_aplikasi/{id}/delete','DaftarAplikasiController@destroy');
Route::get('tableseluruh','SemuaTabelController@tableseluruh')->name('table.seluruh');
Route::get('tablecore','CoreController@tablecore')->name('table.core');
Route::delete('data_core/{id}/delete','CoreController@destroy');
Route::get('anyDataaplikasi/{id}','SemuaTabelController@anyDataaplikasi');
Route::get('anyData/{id}','SemuaTabelController@anyData');
Route::get('anyData1/{id}','PerangkatController@anyData1');
Route::get('seluruh_rak/cetak_pdf_seluruh', 'SemuaTabelController@cetak_pdf_seluruh');
Route::get('cetak_rak/cetak_pdf_rak/{id}', 'SemuaTabelController@cetak_pdf_rak');
Route::get('cetakaplikasi/cetak_pdf_aplikasi/{id}', 'SemuaTabelController@cetak_pdf_aplikasi');
Route::get('cetakserver/cetak_pdf_server/{id}', 'SemuaTabelController@cetak_pdf_server');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
