<?php

class UpdateProductController extends BaseController {

	protected $cart_data;
	protected $product;
	protected $cart_products;
	protected $cart_items_count;
	protected $total;
	protected $product_types;

	public function __construct()
	{
		$this->cart_data = new CartItem;
		$this->product = new Product;	
	}

	public function index($id)
	{
		$this->initialize_all($id);

		return $this->display_view();
	}

	protected function initialize_all($id)
	{
		$this->initialize_cart();
		$this->initialize_product($id);
		$this->initialize_ptypes();
	}

	protected function initialize_cart()
	{
		list( $this->cart_products, $this->cart_items_count, $this->total ) = $this->cart_data->get_cart_data();
	}

	protected function initialize_product($id)
	{
		$this->product = DB::select('SELECT * FROM products WHERE id = ?', array($id));
	}

	protected function initialize_ptypes()
	{
		$this->product_types = DB::select('SELECT id, type_name FROM productTypes 
			                               WHERE parent_id = ? ORDER BY id DESC', array(0));
	}
	protected function display_view()
	{
		return View::make('admin.updateSingle', array('cart_items_count' => $this->cart_items_count,
						                                          'total' => $this->total,
						                                  'cart_products' => $this->cart_products,
						                                  'product' => $this->product,
						                                  'p_types' => $this->product_types		        		        
						                                ));
	}

}//End class