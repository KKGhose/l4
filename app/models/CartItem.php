<?php

class CartItem extends Eloquent {

	protected $table = 'cartItems';
	
	protected $guarded = array();

	public static $rules = array();

	private $_cart_id;

	public function __construct()
	{
		$this->_initialize_cart_id();
	}

	public function get_cart_data()
	{
		$cart_products = DB::select('SELECT products.id, products.product_name, products.product_type, products.product_price, cartItems.quantity, productTypes.type_name
 							         FROM cartItems INNER JOIN products 	
 							         ON cartItems.product_id = products.id
 							         INNER JOIN productTypes
 							         ON products.product_type = productTypes.id  
 							         WHERE cartItems.cart_id LIKE ?', array( $this->_cart_id ));
 	    $cart_items_count = 0;
 	    $total = 0;

 	    if ( $cart_products )
 	    {
 	    	foreach ($cart_products as $cart_product)
 	    	{
 	    		$total += $cart_product->product_price * $cart_product->quantity;
 	    		$cart_items_count += $cart_product->quantity;
 	    	}	
 	    }

		return array($cart_products, $cart_items_count, $total);

	}//End get_cart_data()

	public function add_item_to_cart($product_id)
	{
		//Check to see if item is already in table
	    $cnt = CartItem::whereRaw('cart_id LIKE ? and product_id = ?', array( $this->_cart_id, $product_id ) )->count();

	    if( $cnt > 0 )
	    {
	    	//If item is in table, update quantity to + 1
	    	DB::update('UPDATE cartItems SET quantity = quantity + 1 WHERE product_id = ? AND cart_id LIKE ?', array( $product_id, $this->_cart_id ) );
	    }
	    else
	    {
	    	DB::table('cartItems')->insert( array('cart_id' => $this->_cart_id, 'product_id' => $product_id) );
	    }

	    return;

	}

	public function empty_cart()
	{
		DB::table('cartItems')->where('cart_id', 'LIKE', $this->_cart_id)->delete();

		return;
	}

	/**
	 * Initialize $this->_cart_id with value.
	 *
	 * @return none
	 */
	private function _initialize_cart_id()
	{
		// If ID is in the session, get it from there 
		$this->_cart_id = Session::get('cart_id');

		if(!$this->_cart_id)
		{
			// Generate cart_id and save it to $cart_id and the session
			$this->_cart_id = md5( uniqid(rand(), true) );
			Session::put('cart_id', $this->_cart_id);
		}

		return;
	}

}