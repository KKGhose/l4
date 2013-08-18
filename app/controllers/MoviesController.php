<?php

class MoviesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $count = 0;
	private $items_per_page = 6;
	private $num_pages = 0;
	
	private $_cart_data;

	public function __construct()
	{
		$this->initialize();
		$this->_cart_data = new CartItem;
	}

	private function initialize()
	{
		$this->count = Product::where('product_type','=', 2)->count();
		$this->num_pages = (int)($this->count / $this->items_per_page);	
		if ($this->count % $this->items_per_page) $this->num_pages += 1;
	}

	public function index($page = 1)
	{
		
		$this->log_access('movies.index');

		$skip = ($page - 1) * $this->items_per_page;

		$movies = Product::where('product_type','=', 2)->skip($skip)->orderBy('id', 'desc')->take($this->items_per_page)->get();
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

		return View::make('products.movies', array('movies' => $movies, 
			                                      'num_pages' => $this->num_pages,
			                               'cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products, 
			                                           'page' => $page ));
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



}//End MoviesController