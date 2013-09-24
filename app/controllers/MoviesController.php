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

	private $movies;
	private $moviesModel; 
	
	private $_cart_data;
	private $_log;
	private $cartProducts;
	private $cartItemsCount;
	private $total;
 
	public function __construct()
	{
		$this->initialize();
		$this->_cart_data = new CartItem;
		$this->_log = new AccessLog;
		$this->moviesModel = new Product;
	}

	private function initialize()
	{
		$var = DB::select('SELECT id FROM productTypes WHERE type_name LIKE ?', array('Dvd'));
		
		$this->count = DB::select('SELECT COUNT(*) as cnt FROM products
			                       WHERE product_type = ?', array( $var[0]->id ) );

		$this->numPages = (int)( $this->count[0]->cnt / $this->itemsPerPage );	

		if ($this->count[0]->cnt % $this->itemsPerPage) $this->numPages += 1;
	}

	public function index($page = 1)
	{
		
		$this->_log->save_log($this->_log, 'movies.index');

		$this->skip = ($page - 1) * $this->itemsPerPage;

		/*$movies = DB::select('SELECT products.*, productTypes.type_name, trailers.code
							  FROM products INNER JOIN productTypes
							  INNER JOIN trailers
							  WHERE products.product_type = productTypes.id
							  AND trailers.movie_id = products.id 
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT ?, ?', array('Dvd', $skip, $this->items_per_page));*/
		

		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

		return View::make('products.movies', array('movies' => $movies, 
			                                      'num_pages' => $this->numPages,
			                               'cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products, 
			                                           'page' => $page ));
	}

	private function initialize_movies()
	{
		$this->movies = $this->$moviesModel->getMovies('Dvd', $this->skip, $this->itemsPerPage);
	}

	private function initialize_cart()
	{
		list( $this->cartProducts, $this->cartItemsCount, $this->total ) = $this->_cart_data->get_cart_data();
	}




}//End MoviesController