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

	Route::get('/', 'PagesController@welcome')->name('welcome');
	
	Auth::routes(['verify' => true]);
	
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/langues', 'ContactController@langues')->name('langues');

	Route::get('/about', 'ContactController@about')->name('about');

	Route::resource('profile', 'ProfileController');

	Route::get('/contact', 'ContactController@create')->name('contact.create');
	Route::post('/contact', 'ContactController@store')->name('contact.store');

	Route::get('/ligues/joinLigues', 'LigueController@joinLiguesIndex')->name('joinLiguesIndex');
	Route::post('/ligues/joinLigues', 'LigueController@joinLigues')->name('joinLigues');

	Route::post('/ligues/{ligue}/quitLigue', 'LigueController@quitLigue')->name('quitLigue');

	Route::resource('ligues', 'LigueController');

	Route::get('/ligues/{ligue}/{user}/apuestas/{fecha}', 'ApuestasController@show')->name('apuestas.show');

	Route::resource('/ligues/{ligue}/apuestas', 'ApuestasController')->only([
	    'index', 'store'
	]);

	Route::get('/ligues/{ligue}/classement', 'LigueController@classement')->name('ligueClassement');

	Route::get('/ligues/{ligue}/settings', 'LigueController@settings')->name('ligueSettings');

	Route::resource('games', 'GameController')->middleware('admin');

	Route::resource('equipes', 'EquipeController')->middleware('admin');

	Route::resource('championnats', 'ChampionnatController')->middleware('admin');

	Route::resource('datejournees', 'DateJourneeController')->middleware('admin');

	Route::get('/donate', 'StripeController@index')->name('donate.index');
	Route::post('/donate', 'StripeController@store')->name('donate.store');

	Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function () {

	    Route::get('/', 'AdminController@index')->name('admin.index');
	    Route::post('/ligues/{ligue}/apuestas/{fecha}', 'AdminController@store')->name('admin.store');
	    Route::get('/compare/{journee}', 'AdminController@compare')->name('apuestas.compare');
	    Route::get('/count-points/{journee}', 'AdminController@countPoints')->name('apuestas.points');
	    Route::get('/apuestasorphelines', 'AdminController@apuestasorphelines')->name('apuestasorphelines');
	    Route::delete('/orphansdestroy/{orphan}', 'AdminController@orphansdestroy')->name('orphansdestroy');
	    Route::get('/seasonfinished/{championnat}', 'AdminController@seasonfinished')->name('seasonfinished');
	});

});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
