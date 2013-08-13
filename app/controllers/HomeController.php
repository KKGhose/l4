<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$this->log_access('home.index');

		$movies = Product::where('product_type','=', 2)->orderBy('id', 'desc')->take(3)->get();
		$ebooks = Product::where('product_type','=', 1)->orderBy('id', 'desc')->take(3)->get();
		
		return View::make('welcome', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 'movies' => $movies, 'ebooks' => $ebooks) );
	}

	public function log_access($action = '')
	{
		$log = new AccessLog;
		$log->page_url = 'L4->'.$action;
		$log->ip = $_SERVER['REMOTE_ADDR'];
		$log->host = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
		$log->save();

		return;
	}

}