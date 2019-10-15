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

Route::get('/', function() {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ligues/joinLigues', 'LigueController@joinLiguesIndex')->name('joinLiguesIndex');

Route::post('/ligues/joinLigues', 'LigueController@joinLigues')->name('joinLigues');

Route::resource('ligues', 'LigueController');

Route::resource('/ligues/{ligue}/apuestas', 'ApuestasController');

// Route::get('/ligues/{ligue}/apuestas', 'ApuestasController@index')->name('ligueApuestas');
// Route::post('/ligues/{ligue}/apuestas', 'ApuestasController@store')->name('ligueApuestas');


Route::get('/ligues/{ligue}/classement', 'LigueController@classement')->name('ligueClassement');

Route::get('/ligues/{ligue}/settings', 'LigueController@settings')->name('ligueSettings');
