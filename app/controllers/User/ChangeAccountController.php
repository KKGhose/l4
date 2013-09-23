<?php

class ChangeAccountController extends BaseController {

	private $cart_data;

	public function __construct()
	{
		$this->cart_data = new CartItem;
	}

	public function index($id)
	{
		$user = User::find($id);

		return $this->displayView($user);
	}

	protected function displayView($user)
	{
		list( $cart_products, $cart_items_count, $total ) = $this->cart_data->get_cart_data();


		return View::make('account.change_account', array('cart_items_count' => $cart_items_count,
				            			                              'total' => $total,
							                                  'cart_products' => $cart_products,
							                                  		 'user'	=> $user
			                            			      ));
	}

		
	

}//End class ChangeAccountController