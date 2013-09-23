<?php

class ChangeAccountController extends BaseController {

	$cart_data = new CartItem;	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();


	return View::make('account.change_account', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));

}//End class ChangeAccountController