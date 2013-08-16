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
	private $_cart_id;

	public function __construct()
	{
		$this->initialize();
		$this->_cart_id = Session::get('cart_id');
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
		
		list( $cart_products, $cart_items_count, $total ) = $this->_get_cart_data();

		return View::make('products.movies', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 
			                                         'movies' => $movies, 
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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}