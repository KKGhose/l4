<?php

class UpdateProductController extends BaseController {

	protected $cart_data;

	public function __construct()
	{
		$this->cart_data = new CartItem;	
	}

	public function index($id)
	{
		$product = DB::select('SELECT * FROM products WHERE id = ?', array($id));
		
		list( $cart_products, $cart_items_count, $total ) = $this->cart_data->get_cart_data();

		return View::make('admin.updateSingle', array('cart_items_count' => $cart_items_count,
						                                          'total' => $total,
						                                  'cart_products' => $cart_products,
						                                  'product' => $product			        		            
						                                ));
	}

}//End class