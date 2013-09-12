<?php

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	protected $products;

	protected $guarded = array();

	public static $rules = array();

	function getProducts($productType, $offset, $numOfItems) {

		$this->products = DB::select('SELECT products.*, productTypes.type_name, trailers.code
							  FROM products INNER JOIN productTypes
							  INNER JOIN trailers
							  WHERE products.product_type = productTypes.id
							  AND trailers.movie_id = products.id 
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT ?, ?', array($productType, $offset, $numOfItems));

		return $this->products;
		
	}//End method getProducts

}//End class Product