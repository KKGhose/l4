<?php

class EbooksController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	private $count = 0;
	private $items_per_page = 6;
	private $num_pages = 0;

	private $_cart_data;
    private $_log;


	public function __construct()
	{
		$this->initialize();
		$this->_cart_data = new CartItem;
		$this->_log = new AccessLog;
	}

	private function initialize()
	{
		$this->count = Product::where('product_type','=', 1)->count();
		$this->num_pages = (int)($this->count / $this->items_per_page);	
		if ($this->count % $this->items_per_page) $this->num_pages += 1;
	}

	public function index($page = 1)
	{
		$this->_log->save_log($this->_log, 'ebooks.index');

		$skip = ($page - 1) * $this->items_per_page;

		$ebooks = Product::where('product_type','=', 1)->skip($skip)->orderBy('id', 'desc')->take($this->items_per_page)->get();
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

		return View::make('products.ebooks', array('ebooks' => $ebooks, 
			                                      'num_pages' => $this->num_pages,
			                               'cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products, 
			                                           'page' => $page ));
	}
	

}//End EbooksController