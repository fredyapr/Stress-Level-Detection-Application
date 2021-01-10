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
    return view('template.front.index');
});

// Route::get('/pertanyaan','PertanyaanController@index');
// Route::post('/pertanyaan/create','PertanyaanController@create');
// Route::get('/pertanyaan/{id_pertanyaan}/edit','PertanyaanController@edit');
// Route::post('/pertanyaan/{id_pertanyaan}/update','PertanyaanController@update');
// Route::get('/pertanyaan/{id_pertanyaan}/delete','PertanyaanController@delete');

// Route::get('/kategori','KategoriController@index');
// Route::post('/kategori/create','KategoriController@create');
// Route::get('/kategori/{id_kategori}/edit','KategoriController@edit');
// Route::post('/kategori/{id_kategori}/update','KategoriController@update');
// Route::get('/kategori/{id_kategori}/delete','KategoriController@delete');

Auth::routes();
Route::namespace ('Auth')->group(function () {
    // Controllers Within The "App\Http\Controllers\Auth" Namespace
    Route::get('/login', 'LoginController@getLogin')->middleware('guest');
    Route::post('/login', 'LoginController@postLogin')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/klinik','KlinikController@index');
Route::post('/klinik/create','KlinikController@create');
Route::get('/klinik/{id_klinik}/edit','KlinikController@edit');
Route::post('/klinik/{id_klinik}/update','KlinikController@update');
Route::get('/klinik/{id_klinik}/delete','KlinikController@delete');

Route::get('/kuesioner','KuesionerController@index');
Route::post('/kuesioner/create','KuesionerController@create');
Route::get('/kuesioner/{id_kuesioner}/edit','KuesionerController@edit');
Route::post('/kuesioner/{id_kuesioner}/update','KuesionerController@update');
Route::get('/kuesioner/{id_kuesioner}/delete','KuesionerController@delete');

Route::get('/solusi','SolusiController@index');
Route::post('/solusi/create','SolusiController@create');
Route::get('/solusi/{id_kuesioner}/edit','SolusiController@edit');
Route::post('/solusi/{id_kuesioner}/update','SolusiController@update');
Route::get('/solusi/{id_kuesioner}/delete','SolusiController@delete');

// /*NEO TECH*/
