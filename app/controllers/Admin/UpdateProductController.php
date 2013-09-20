<?php

class UpdateProductController extends BaseController {

	protected $cart_data;
	protected $cart_products;
	protected $cart_items_count;
	protected $total;
	
	protected $product_types;

	protected $product_m;
	protected $product;

	public function __construct()
	{
		$this->cart_data = new CartItem;
		$this->product_m = new Product;	
	}

	public function index($id, $type)
	{
		$this->initialize_all($id, $type);

		return $this->display_view();
	}

	protected function initialize_all($id, $type)
	{

		$this->initialize_product($id, $type);
		$this->initialize_cart();
		$this->initialize_ptypes();
	}

	protected function initialize_cart()
	{
		list( $this->cart_products, $this->cart_items_count, $this->total ) = $this->cart_data->get_cart_data();
	}

	protected function initialize_product($id, $type)
	{
		$this->product = $this->product_m->getProduct($id, $type);
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