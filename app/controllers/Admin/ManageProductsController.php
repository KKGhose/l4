<?php

class ManageProductsController extends BaseController {

	private $count = 0;
	private $items_per_page = 15;
	private $num_pages = 0;
	private $products;

	private $_cart_data;

	public function __construct() {
		$this->products = new Product;
		$this->_cart_data = new CartItem;
	}

	public function index($page = 1)
	{
		$movies = $this->products->getMovies('Dvd', 0, 12);
	    $ebooks = $this->products->getProducts('Book', 0, 12);

		$skip = ($page - 1) * $this->items_per_page;
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

        return View::make('admin.update_product', array('cart_items_count' => $cart_items_count,
							                                          'total' => $total,
							                                  'cart_products' => $cart_products,
							                                  	     'movies' => $movies,
							                                  	     'ebooks' => $ebooks
				                                              ));
	}

}//End class