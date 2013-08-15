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



Route::get('/', 'HomeController@index');



Route::get('/movies/{offset?}', 'MoviesController@index');

Route::get('/ebooks/{offset?}', 'EbooksController@index');

Route::get('/add_to_cart/{product_id}/{uri?}', function($product_id, $uri = null) {

	//$product = Product::find($product_id);
	
	// If ID is in the session, get it from there 
	$cart_id = Session::get('cart_id');

	if(!$cart_id)
	{
		// Generate cart_id and save it to $cart_id and the session
		$cart_id = md5( uniqid(rand(), true) );
		Session::put('cart_id', $cart_id);
	}

	$cart_item = new CartItem;

	$cart_item->cart_id = $cart_id;
	$cart_item->product_id = $product_id;
	$cart_item->save();

	//$cnt = CartItem::whereRaw('cart_id LIKE ? and product_id = ?', array( $cart_id, $item_id ) );



	if( $uri == 'movies' )
		return Redirect::to('/movies/');

	if( $uri == 'ebooks')
		return Redirect::to('/ebooks/');

	return Redirect::to('/');
}); 