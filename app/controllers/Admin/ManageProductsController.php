<?php

class ManageProductsController extends BaseController {

	private $count = 0;
	private $itemsPerPage = 12;
	private $products;

	private $moviesNumPages = 0;
	private $moviesCount;

	private $_cart_data;

	public function __construct() {
		$this->products = new Product;
		$this->_cart_data = new CartItem;
		$this->initialize();
	}

	public function index($moviePage = 1, $type = 'Dvd')
	{
		$movieSkip = ($moviePage - 1) * $this->itemsPerPage;

		$movies = $this->products->getMovies('Dvd', $movieSkip, $this->itemsPerPage);
		
	    $ebooks = $this->products->getProducts('Book', 0, $this->itemsPerPage);
	    $ebooksCount = $this->products->getProductCount('Book');

		
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

        return View::make('admin.update_product', array('cart_items_count' => $cart_items_count,
							                                          'total' => $total,
							                                  'cart_products' => $cart_products,
							                                  	     'movies' => $movies,
							                                  	     'moviesCount' => $this->moviesCount,
							                                  	     'ebooks' => $ebooks,
							                                  	     'ebooksCount' => $ebooksCount,
							                                  	     'moviePage' => $moviePage,
							                                  	     'moviesNumPages' => $this->moviesNumPages,
							                                  	     'type' => $type
				                                              ));
	}

	private function initialize()
	{
		$this->moviesCount = $this->products->getProductCount('Dvd');

		$this->moviesNumPages = (int)( $this->moviesCount[0]->count / $this->itemsPerPage );	

		if ($this->moviesCount[0]->count % $this->itemsPerPage) $this->moviesNumPages += 1;
	}


}//End class