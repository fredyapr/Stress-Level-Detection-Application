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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/pertanyaan','PertanyaanController@index');
// Route::post('/pertanyaan/create','PertanyaanController@create');
// Route::get('/pertanyaan/{id_pertanyaan}/edit','PertanyaanController@edit');
// Route::post('/pertanyaan/{id_pertanyaan}/update','PertanyaanController@update');
// Route::get('/pertanyaan/{id_pertanyaan}/delete','PertanyaanController@delete');

Route::post('/klinik','KlinikController@index');
Route::post('/klinik/create','KlinikController@create');
Route::get('/klinik/{id_klinik}/edit','KlinikController@edit');
Route::post('/klinik/{id_klinik}/update','KlinikController@update');
Route::get('/klinik/{id_klinik}/delete','KlinikController@delete');

Route::post('/kuesioner','KuesionerController@index');
Route::post('/kuesioner/create','KuesionerController@create');
Route::get('/kuesioner/{id_kuesioner}/edit','KuesionerController@edit');
Route::post('/kuesioner/{id_kuesioner}/update','KuesionerController@update');
Route::get('/kuesioner/{id_kuesioner}/delete','KuesionerController@delete');

Route::post('/solusi','SolusiController@index');
Route::post('/solusi/create','SolusiController@create');
Route::get('/solusi/{id_kuesioner}/edit','SolusiController@edit');
Route::post('/solusi/{id_kuesioner}/update','SolusiController@update');
Route::get('/solusi/{id_kuesioner}/delete','SolusiController@delete');

Route::post('/hasil','HasilController@hasil');
Route::post('/history','HasilController@history');

Route::post('/register','PenggunaController@regis');
Route::post('/login','PenggunaController@login');

// Route::get('/nilai','NilaiController@index');
// Route::post('/nilai_create','NilaiController@create');
// Route::get('/nilai/{id_nilai}/edit','NilaiController@edit');
// Route::post('/nilai/{id_nilai}/update','NilaiController@update');
// Route::get('/nilai/{id_nilai}/delete','NilaiController@delete');
