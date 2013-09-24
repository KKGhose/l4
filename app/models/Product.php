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

	protected $productIds;

	public function __construct()
	{
		$this->productIds = Cache::get('productIds');
	}

	function getMovies($productType, $offset, $numOfItems) {

		//We fetch all movie id's from memcached
		$movieIds = Cache::get('movieIds');

		//We fetch movies data from memcached 
		if($movieIds)
		{
			for ($i = $offset; $i < $offset + $numOfItems && $i < sizeof($movieIds); $i++)
			{
				$movieId[] = $movieIds[$i];
			}

			foreach ($movieId as $key => $value) 
			{
				$this->products[] = (object) Cache::get('product_' . $value);
			}

			return $this->products;
		}

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


	function getProduct($productId, $type) {

		if ($type == 'Book')
		{
			$product = null;

			//We fetch product from cache
			$key = 'product_' . $productId;

			if ( Cache::has($key))
			{
				$product = Cache::get($key); 
			}	
			

			//If found we return it otherwise we fetch it from database
			if ($product) return $product;

			$product = DB::select('SELECT products.*, productTypes.type_name
							  		FROM products INNER JOIN productTypes
							  		WHERE products.id = ?
							  		AND productTypes.id = products.product_type ', array($productId));

			//We convert $product from object into associative array and return it to caller
			return get_object_vars($product[0]); 
		}
		elseif ($type == 'Dvd')
		{
			$product = null;

			//We fetch product from cache
			$key = 'product_' . $productId;
		
			if ( Cache::has($key))
			{
				$product = Cache::get($key); 
			}	

			//If found we return it otherwise we fetch it from database
			if ($product) return $product;

			$product = DB::select('SELECT products.*, productTypes.type_name, trailers.code
						 		   FROM products INNER JOIN productTypes
							       INNER JOIN trailers
							       WHERE products.id = ?
							       AND trailers.movie_id = products.id 
							       AND productTypes.id = products.product_type ', array($productId));

			//We convert $product from object into associative array and return it to caller
			return get_object_vars($product[0]); 
		}

		return null;	
		
		
	}//End method getMoviess

	function getCount($productType)
	{
		$count = DB::select('SELECT COUNT(*) AS num FROM products 
							 INNER JOIN productTypes
							 WHERE products.product_type = productTypes.id
							 AND productTypes.type_name LIKE ?', array($productType));

		return (int) $count[0]->num;
	}

}//End class Product