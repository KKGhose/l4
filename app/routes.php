<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function() {

	$log = new AccessLog;
	$log->page_url = 'l4->home->index';
	$log->ip = $_SERVER['REMOTE_ADDR'];
	$log->host = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
	$log->save();

	return Redirect::to('view_home');
});

Route::get('view_home', 'HomeController@index');



Route::get('/movies/{offset?}', 'MoviesController@index');

Route::get('/ebooks/{offset?}', 'EbooksController@index');