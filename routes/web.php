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

Route::group([

	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 
					'no-cache']], function(){

	Route::get('/', 'PagesController@welcome')->name('welcome');
	
	Auth::routes(['verify' => true]);
	
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/langues', 'LanguesController@index')->name('langues');
	Route::get('/about', 'AboutController@index')->name('about');

	Route::resource('profile', 'ProfileController');

	Route::get('/contact', 'ContactController@create')->name('contact.create');
	Route::post('/contact', 'ContactController@store')->name('contact.store');

	Route::get('/ligues/joinLigues', 'LigueUserController@create')->name('ligueuser.create');
	Route::post('/ligues/joinLigues', 'LigueUserController@store')->name('ligueuser.store');
	Route::post('/ligues/{ligue}/quitLigue', 'LigueUserController@destroy')->name('ligueuser.destroy');

	Route::resource('ligues', 'LigueController');

	Route::get('/ligues/{ligue}/{user}/apuestas/{fecha}', 'ApuestasController@show')->name('apuestas.show');
	Route::resource('/ligues/{ligue}/apuestas', 'ApuestasController')->only([
	    'create', 'store'
	]);

	Route::get('/ligues/{ligue}/classement', 'ClassementLigueController@show')->name('classementligue.show');

	Route::get('/ligues/{ligue}/settings', 'LigueSettingsController@show')->name('ligueSettings.show');

	Route::resource('games', 'GameController')->middleware('admin');
	Route::resource('equipes', 'EquipeController')->middleware('admin');
	Route::resource('championnats', 'ChampionnatController')->middleware('admin');
	Route::resource('datejournees', 'DateJourneeController')->middleware('admin');

	// Route::get('/donate', 'StripeController@index')->name('donate.index');
	// Route::post('/donate', 'StripeController@store')->name('donate.store');

	Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function () {

	    Route::get('/', 'AdminController@index')->name('admin.index');
	    Route::post('/ligues/{ligue}/apuestas/{fecha}', 'AdminController@store')->name('admin.store');

	    Route::get('/compare/{journee}', 'CompareApuestasController@update')->name('compareapuestas.update');

	    Route::get('/count-points/{journee}', 'CountPointsController@update')->name('countpoints.update');

	    Route::get('/apuestasorphelines', 'ApuestasOrphansController@index')->name('orphans.index');
	    Route::delete('/orphansdestroy/{orphan}', 'ApuestasOrphansController@destroy')->name('orphans.destroy');
	    
	    Route::get('/seasonfinished/{championnat}', 'SeasonController@update')->name('seasonfinished.update');
	});

});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
