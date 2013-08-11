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

	public function __construct()
	{
		$this->initialize();
	}

	private function initialize()
	{
		$this->count = Product::where('product_type','=', 2)->count();
		$this->num_pages = (int)($this->count / $this->items_per_page);
		if ($this->count % $this->items_per_page) $this->num_pages += 1;
	}

	public function index($offset = 0)
	{
		//
		$movies = Product::where('product_type','=', 2)->skip($offset)->orderBy('id', 'desc')->take($this->items_per_page)->get();
		
		return View::make('movies.movies', array('base_url' => 'http://'.$_SERVER['SERVER_NAME'], 
			                                       'movies' => $movies, 
			                                    'num_pages' => $this->num_pages,
			                                    'offest' => $offset ));
	}

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