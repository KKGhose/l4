<?php

class HomeController extends BaseController {

	
	private $_cart_id;

	private $_cart_data;

	public function __construct()
	{
		$this->_cart_data = new CartItem;
	}

	public function index()
	{
		$this->log_access('home.index');

		$movies = Product::where('product_type','=', 2)->orderBy('id', 'desc')->take(3)->get();
		$ebooks = Product::where('product_type','=', 1)->orderBy('id', 'desc')->take(3)->get();

		
 		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

 	    

		return View::make('welcome', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 
			                               'movies' => $movies, 
			                               'ebooks' => $ebooks,
			                               'cart_items_count' => $cart_items_count,
			                               'total' => $total,
			                               'cart_products' => $cart_products ));
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

	
}//End HomeController