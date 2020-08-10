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

Route::get('/', 'FilmController@welcome')->name('welcome');


Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	//films
	Route::get('/film', 'FilmController@index')->name('film');

	Route::get('/new-film',  'FilmController@new')->name('addFilm');

	Route::post('film',  'FilmController@store')->name('newFilm');

	Route::get('/buy-film/{id}',  'FilmController@show')->name('purchase');

	Route::post('/buy-film/{id}',  'FilmController@update')->name('updateFilm');

	Route::post('/buy-film/{id}',  'FilmController@show')->name('purchase');

	// Route::get('deleteUser/{id}',  'UserController@destroy')->name('deleteUser');
	
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/user', 'HomeController@user')->name('user');

	Route::get('/user/{id}', 'HomeController@show')->name('showUser');

	Route::get('/password/{id}', 'HomeController@password')->name('Password');

	Route::post('/user/{id}', 'HomeController@update')->name('updateUser');

	Route::post('/password/{id}', 'HomeController@updatePassword')->name('updatePassword');
});