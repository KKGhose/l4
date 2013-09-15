<?php

class ManageProductsController extends BaseController {

	private $count = 0;
	private $itemsPerPage = 12;
	private $products;

	private $moviesNumPages = 0;
	private $moviesCount;

	private $ebooksNumPages = 0;
	private $ebooksCount;

	private $_cart_data;

	public function __construct() {
		$this->products = new Product;
		$this->_cart_data = new CartItem;
		$this->initialize();
	}

	public function index($moviePage = 1, $ebookPage = 1, $type = 'Dvd')
	{
		$movieSkip = ($moviePage - 1) * $this->itemsPerPage;
		$ebookSkip = ($ebookPage - 1) * $this->itemsPerPage;

		$movies = $this->products->getMovies('Dvd', $movieSkip, $this->itemsPerPage);
		
	    $ebooks = $this->products->getProducts('Book', $ebookSkip, $this->itemsPerPage);
	    

		
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

        return View::make('admin.update_product', array('cart_items_count' => $cart_items_count,
							                                          'total' => $total,
							                                  'cart_products' => $cart_products,
							                                  	     'movies' => $movies,
							                                  	     'ebooks' => $ebooks,
							                                  	     'moviesCount' => $this->moviesCount,
							                                  	     'ebooksCount' => $this->ebooksCount,
							                                  	     'moviesNumPages' => $this->moviesNumPages,
							                                  	     'ebooksNumPages' => $this->ebooksNumPages,
							                                  	     'moviePage' => $moviePage,
							                                         'ebookPage' =>  $ebookPage,
							                                  	     'type' => $type
				                                              ));
	}

	private function initialize()
	{
		$this->moviesCount = $this->products->getProductCount('Dvd');
		$this->moviesNumPages = (int)( $this->moviesCount[0]->count / $this->itemsPerPage );	
		if ($this->moviesCount[0]->count % $this->itemsPerPage) $this->moviesNumPages += 1;

		$this->ebooksCount = $this->products->getProductCount('Book');
		$this->ebooksNumPages = (int)( $this->ebooksCount[0]->count / $this->itemsPerPage );	
		if ($this->ebooksCount[0]->count % $this->itemsPerPage) $this->ebooksNumPages += 1;
	}


}//End class