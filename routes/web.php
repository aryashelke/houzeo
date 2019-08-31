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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add', 'HeuzeoController@index')->name('add');
Route::get('/home', 'HeuzeoController@listView')->name('home');
Route::post('/add-film', 'HeuzeoController@saveFilm')->name('add-film');
Route::post('/add-people', 'HeuzeoController@savePeople')->name('add-people');
Route::post('/list-film', 'HeuzeoController@getFilmList')->name('list-film');
Route::post('/list-people', 'HeuzeoController@getPeopleList')->name('list-people');