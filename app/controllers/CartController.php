<?php

class CartController extends BaseController {

	private $_cart_data;

	public function __construct()
	{
		$this->_cart_data = new CartItem;
	}

	/**
	 * Add item to cartItems table.
	 *
	 * @return Redirect to caller 
	 */
	public function add_item($product_id, $uri = '/')
	{
		
		$this->_cart_data->add_item_to_cart( $product_id );

		return Redirect::to($uri);
	}

	
	/**
	 * Empty cartItems table based on cart id value.
	 *
	 * @return Redirect to caller
	 */
	public function empty_cart($uri = '/')
	{
		$this->_cart_data->empty_cart();

		return Redirect::to($uri);
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

	

}//End CartController