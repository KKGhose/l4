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
		$movies = Product::where('product_type','=', 2)->take(3)->get();
		$ebooks = Product::where('product_type','=', 1)->take(3)->get();
		return View::make('welcome', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 'movies' => $movies, 'ebooks' => $ebooks) );
	}

}