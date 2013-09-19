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

	function getMovies($productType, $offset, $numOfItems) {

		$this->products = DB::select('SELECT products.*, productTypes.type_name, trailers.code
							  FROM products INNER JOIN productTypes
							  INNER JOIN trailers
							  WHERE products.product_type = productTypes.id
							  AND trailers.movie_id = products.id 
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT ?, ?', array($productType, $offset, $numOfItems));

		return $this->products;
		
	}//End method getMoviess


	function getProducts($productType, $offset, $numOfItems) {

		$this->products = DB::select('SELECT products.*, productTypes.type_name
							  FROM products INNER JOIN productTypes
							  WHERE products.product_type = productTypes.id
							  AND productTypes.type_name LIKE ?  
							  ORDER BY products.id DESC LIMIT ?, ?', array($productType, $offset, $numOfItems));

		return $this->products;
		
	}//End method getProducts

	function getProductCount($productType) {

		$typeId = DB::select('SELECT id FROM productTypes WHERE type_name = ?', array($productType));

		return $product = DB::select('SELECT COUNT(*) as count FROM products 
						   			  WHERE product_type = ?', array($typeId[0]->id));
	}


	function getProduct($productId, $type = null) {

		if ($type)
		{
			$this->products = DB::select('SELECT products.*, productTypes.type_name
							  FROM products INNER JOIN productTypes
							  WHERE products.id = ?
							  AND productTypes.id = products.product_type ', array($productId));

			return $this->products;
		}

		$this->products = DB::select('SELECT products.*, productTypes.type_name, trailers.code
							  FROM products INNER JOIN productTypes
							  INNER JOIN trailers
							  WHERE products.id = ?
							  AND trailers.movie_id = products.id 
							  AND productTypes.id = products.product_type ', array($productId));

		return $this->products;
		
	}//End method getMoviess

}//End class Product