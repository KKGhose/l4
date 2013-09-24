<?php

class MoviesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $count = 0;
	private $itemsPerPage = 6;
	private $numPages = 0;
	private $skip;
	private $page;

	private $movies;
	private $moviesModel; 
	
	private $_cart_data;
	private $_log;
	private $cartProducts;
	private $cartItemsCount;
	private $total;
 
	public function __construct()
	{
		$this->_cart_data = new CartItem;
		$this->_log = new AccessLog;
		$this->moviesModel = new Product;
	}

	
	public function index($page = 1)
	{
		$this->initialize_main($page);

		$this->initialize_movies();

		$this->initialize_cart();

		return $this->displayView();
	}

	private function initialize_main($page)
	{	
		$this->count = $this->moviesModel->getCount('Dvd');

		$this->numPages = (int)( $this->count / $this->itemsPerPage );	

		if ($this->count % $this->itemsPerPage) $this->numPages += 1;

		$this->page = $page;
		
		$this->_log->save_log($this->_log, 'movies.index');

		$this->skip = ($this->page - 1) * $this->itemsPerPage;
	}

	private function initialize_movies()
	{
		$this->movies = $this->moviesModel->getMovies('Dvd', $this->skip, $this->itemsPerPage);
	}

	private function initialize_cart()
	{
		list( $this->cartProducts, $this->cartItemsCount, $this->total ) = $this->_cart_data->get_cart_data();
	}

	private function displayView()
	{
		return View::make('products.movies', array('movies' => $this->movies, 
			                                      'num_pages' => $this->numPages,
			                               'cart_items_count' => $this->cartItemsCount,
			                                          'total' => $this->total,
			                                  'cart_products' => $this->cartProducts, 
			                                           'page' => $this->page ));
	}


}//End MoviesController