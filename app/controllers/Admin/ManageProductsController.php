<?php

class ManageProductsController extends BaseController {

	private $count = 0;
	private $itemsPerPage = 12;
	private $products;

	private $movies;
	private $moviesNumPages = 0;
	private $moviesCount;

	private $ebooks;
	private $ebooksNumPages = 0;
	private $ebooksCount;

	private $_cart_data;

	public function __construct() {

		$this->products = new Product;
		$this->_cart_data = new CartItem;
	}

	public function index($moviePage = 1, $ebookPage = 1, $type = 'Dvd')
	{
		$this->initialize_all($moviePage, $ebookPage);

	    return $this->displayView($moviePage, $ebookPage, $type);		
	}

	private function displayView($moviePage, $ebookPage, $type) {

		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

        return View::make('admin.update_product', array('cart_items_count' => $cart_items_count,
							                                          'total' => $total,
							                                  'cart_products' => $cart_products,
							                                  	     'movies' => $this->movies,
							                                  	     'ebooks' => $this->ebooks,
							                                  	     'moviesCount' => $this->moviesCount,
							                                  	     'ebooksCount' => $this->ebooksCount,
							                                  	     'moviesNumPages' => $this->moviesNumPages,
							                                  	     'ebooksNumPages' => $this->ebooksNumPages,
							                                  	     'moviePage' => $moviePage,
							                                         'ebookPage' =>  $ebookPage,
							                                  	     'type' => $type
				                                              ));	

	}

	private function initialize_all($moviePage, $ebookPage)
	{
		$this->getMovies($moviePage);

	    $this->getEbooks($ebookPage);
	}

	private function getMovies($moviePage) {

		$this->initialize_movies();
		$movieSkip = ($moviePage - 1) * $this->itemsPerPage;
		$this->movies = $this->products->getMovies('Dvd', $movieSkip, $this->itemsPerPage);
	}

	private function getEbooks($ebookPage) {

		$this->initialize_ebooks();
		$ebookSkip = ($ebookPage - 1) * $this->itemsPerPage;
		$this->ebooks = $this->products->getProducts('Book', $ebookSkip, $this->itemsPerPage);
	}

	private function initialize_movies() {

		$this->moviesCount = $this->products->getProductCount('Dvd');
		$this->moviesNumPages = (int)( $this->moviesCount[0]->count / $this->itemsPerPage );	
		if ($this->moviesCount[0]->count % $this->itemsPerPage) $this->moviesNumPages += 1;
	}

	private function initialize_ebooks() {

		$this->ebooksCount = $this->products->getProductCount('Book');
		$this->ebooksNumPages = (int)( $this->ebooksCount[0]->count / $this->itemsPerPage );	
		if ($this->ebooksCount[0]->count % $this->itemsPerPage) $this->ebooksNumPages += 1;
	}


}//End class