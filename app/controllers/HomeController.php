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

		//$movies = Product::where('product_type','=', 11)->orderBy('id', 'desc')->take(3)->get();
		//$ebooks = Product::where('product_type','=', 10)->orderBy('id', 'desc')->take(3)->get();

		$movies = DB::select('SELECT products.*, productTypes.type_name
							  FROM products INNER JOIN productTypes
							  WHERE products.product_type = productTypes.id
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT 3', array('Dvd'));

		$ebooks = DB::select('SELECT products.*, productTypes.type_name
							  FROM products INNER JOIN productTypes
							  WHERE products.product_type = productTypes.id
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT 3', array('Book'));
									
		
 		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

 	    

		return View::make('welcome', array('movies' => $movies, 
			                               'ebooks' => $ebooks,
			                               'cart_items_count' => $cart_items_count,
			                               'total' => $total,
			                               'cart_products' => $cart_products ));
	}

	
}//End HomeController