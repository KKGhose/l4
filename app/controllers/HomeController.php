<?php

class HomeController extends BaseController {

	
	private $_cart_id;

	private $_cart_data;

	private $_log;

	public function __construct()
	{
		$this->_cart_data = new CartItem;
		$this->_log = new AccessLog;
	}

	public function index()
	{
		$this->_log->save_log($this->_log, 'home.index');

		$movies = Product::where('product_type','=', 2)->orderBy('id', 'desc')->take(3)->get();
		$ebooks = Product::where('product_type','=', 1)->orderBy('id', 'desc')->take(3)->get();

		
 		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

 	    

		return View::make('welcome', array('movies' => $movies, 
			                               'ebooks' => $ebooks,
			                               'cart_items_count' => $cart_items_count,
			                               'total' => $total,
			                               'cart_products' => $cart_products ));
	}

	
}//End HomeController