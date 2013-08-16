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
	private $_cart_id;

	public function __construct()
	{
		$this->_cart_id = Session::get('cart_id');
	}

	public function index()
	{
		$this->log_access('home.index');

		$movies = Product::where('product_type','=', 2)->orderBy('id', 'desc')->take(3)->get();
		$ebooks = Product::where('product_type','=', 1)->orderBy('id', 'desc')->take(3)->get();

		
 		list( $cart_products, $cart_items_count, $total ) = $this->_get_cart_data();

 		$stuff = DB::select('SELECT products.product_name, products.product_price, cartItems.quantity
 							 FROM cartItems INNER JOIN products
 							 ON cartItems.product_id = products.id
 							 WHERE cartItems.cart_id LIKE ?', array( $this->_cart_id ));

		return View::make('welcome', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 
			                               'movies' => $movies, 
			                               'ebooks' => $ebooks,
			                               'cart_items_count' => $cart_items_count,
			                               'total' => $total,
			                               'cart_products' => $cart_products,
			                               'stuff' => $stuff ));
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

	private function _get_cart_data()
	{
		$cart_products = array();
		
		$count = CartItem::whereRaw( 'cart_id LIKE ?', array( $this->_cart_id ) )->count();
		$cart_items_count = 0;
		$total = 0;

		if ($count > 0)
		{
			$cart_items = CartItem::where( 'cart_id', 'LIKE', $this->_cart_id )->get();
			

			foreach($cart_items as $cart_item)
			{
				$cart_products[] = Product::find( $cart_item->product_id );
				$cart_items_count += (int)$cart_item->quantity;
			}


			
			foreach($cart_products as $cart_product)
				$total += $cart_product->product_price;
			
		}

		return array($cart_products, $cart_items_count, $total);

	}//End get_cart_data()

}//End HomeController