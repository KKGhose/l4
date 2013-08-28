<?php


class AccessLogsController extends BaseController {

	private $count = 0;
	private $items_per_page = 20;
	private $num_pages = 0;

	private $_cart_data;

	private function initialize()
	{
		$this->count = DB::select('SELECT COUNT(*) as num FROM accessLogs');
		$this->num_pages = (int)($this->count[0]->num / $this->items_per_page);	
		if ($this->count % $this->items_per_page) $this->num_pages += 1;
	}

	public function __construct()
	{
		$this->initialize();
		$this->_cart_data = new CartItem;
	}

	public function index($page = 1)
	{
		$skip = ($page - 1) * $this->items_per_page;

		$logs = DB::select('SELECT * FROM accessLogs ORDER BY id DESC LIMIT ?, ?', array($skip, $this->items_per_page)); 
		
		list( $cart_products, $cart_items_count, $total ) = $this->_cart_data->get_cart_data();

        return View::make('admin.view_access_log', array('logs' => $logs, 
			                                        'num_pages' => $this->num_pages,
			                                 'cart_items_count' => $cart_items_count,
			                                            'total' => $total,
			                                    'cart_products' => $cart_products, 
			                                             'page' => $page
			                                             ));
	}


}//End class AccessLogsController
