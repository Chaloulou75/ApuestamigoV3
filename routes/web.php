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

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 
					'no-cache']], function(){

	Route::get('/', function() {
	    return view('index');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/langues', 'HomeController@langues')->name('langues');

	Route::get('/contact', 'ContactController@create')->name('contact.create');
	Route::post('/contact', 'ContactController@store')->name('contact.store');

	Route::get('/ligues/joinLigues', 'LigueController@joinLiguesIndex')->name('joinLiguesIndex');

	Route::post('/ligues/joinLigues', 'LigueController@joinLigues')->name('joinLigues');

	Route::resource('ligues', 'LigueController');

	Route::get('/ligues/{ligue}/apuestas/{fecha}', 'ApuestasController@show')->name('apuestas.show');

	Route::resource('/ligues/{ligue}/apuestas', 'ApuestasController')->only([
	    'index', 'store'
	]);

	Route::get('/ligues/{ligue}/classement', 'LigueController@classement')->name('ligueClassement');

	Route::get('/ligues/{ligue}/settings', 'LigueController@settings')->name('ligueSettings');

	Route::resource('games', 'GameController')->middleware('admin');

	Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function () {

	    Route::get('/', 'AdminController@index')->name('admin.index');
	    Route::post('/ligues/{ligue}/apuestas/{fecha}', 'AdminController@store')->name('admin.store');
	    Route::get('/compare/{journee}', 'AdminController@compare')->name('apuestas.compare');
	    Route::get('/count-points/{journee}', 'AdminController@countPoints')->name('apuestas.points');
	});

});
