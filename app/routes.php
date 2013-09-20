<?php



Route::get('/', 'HomeController@index');

Route::get('movies/{offset?}', 'MoviesController@index');

Route::get('ebooks/{offset?}', 'EbooksController@index');

Route::get('add_to_cart/{product_id}/{uri?}', 'CartController@add_item');

Route::get('empty_cart/{uri?}', 'CartController@empty_cart');



/*
*
*	Login and registration routes
*
*/

Route::get('login', function() {

	if(Auth::check()) return Redirect::to('account');
	
	$cart_data = new CartItem;

	$log = new AccessLog;
	$log->save_log($log, 'Login->index');
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('login.index', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
});

Route::get('registration', function() {
	
	if(Auth::check()) return Redirect::to('account');

	$cart_data = new CartItem;

	$log = new AccessLog;
	$log->save_log($log, 'Login->register');
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('login.register', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
});

//This route is accessed through confirmation email sent to new member.
//Upon firing the the new member data is transfered form signups table to users table.
Route::get('confirm/{code?}', function($code = null) {

	$signup = DB::select('SELECT email, password, firstname, lastname FROM signups WHERE confirm_code LIKE ?', array($code));
	 
	if(!$signup) return Redirect::to('not_found');

	$email =  $signup[0]->email;

	DB::insert('INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ? , ?)', array($signup[0]->email,
																									 $signup[0]->password,
																									 $signup[0]->firstname,
																									 $signup[0]->lastname
																									 ));

    DB::delete('DELETE FROM signups WHERE confirm_code LIKE ?', array($code));

	return Redirect::to('login')->with('success_message', 'Your account has been confirmed!')
								->with('email', $email);
});

Route::get('logout', function()
{
	//We set logged flag to 0 on logout
	DB::update('UPDATE users SET logged = 0 , updated_at = CURRENT_TIMESTAMP WHERE email LIKE ?', array(Auth::user()->email));
 
    Auth::logout();

    return Redirect::to('login');
});

//------------------ End login and registration routes ----------------------------------


//-------------------User Account routes------------------------------------------------------

Route::get('account', function() {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');
	
	$cart_data = new CartItem;	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	if( !Auth::user()->admin )
	{
		return View::make('account.index', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
	}

	return View::make('admin.index', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
		
});

Route::get('open-orders', function() {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');
	
	$cart_data = new CartItem;	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	if (Auth::user()->admin)
		return View::make('admin.open_orders', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
	else	
		return View::make('account.open_orders', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
		
});

Route::get('cart-checkout', function() {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');
	
	$cart_data = new CartItem;	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	$auth_code = array();

	$auth_code = array( 'MERCHANT_ID' => '13466',
						'AMOUNT' => $total,
	   				    'ORDER_NUMBER' => '123456',
						'REFERENCE_NUMBER' => '',
						'ORDER_DESCRIPTION' => 'Online Store dummy buy',
						'CURRENCY' => 'EUR',
						'RETURN_ADDRESS' => url('checkout_success'),
						'CANCEL_ADDRESS' => url('checkout_cancel'),
						'PENDING_ADDRESS' => '',
						'NOTIFY_ADDRESS' => url('checkout_notify'),
						'TYPE' => 'S1',
						'CULTURE' => 'fi_FI',
						'PRESELECTED_METHOD' => '',
						'MODE' =>  '1',
						'VISIBLE_METHODS' => '',
						'GROUP' => '' );
							
	$AUTHCODE = '6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ';

	foreach ($auth_code as $key => $value)
	{
		$AUTHCODE .= '|' . $value; 	
	}
							
	$AUTHCODE = strtoupper( md5($AUTHCODE) );

	if (Auth::user()->admin)
		return View::make('admin.cart_checkout', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products,
			                                  	  'AUTHCODE'  => $AUTHCODE
			                                  ));
	else	
		return View::make('account.cart_checkout', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products,
			                                  	  'AUTHCODE'  => $AUTHCODE
			                                  ));
		
});



//-------------------Admin routes------------------------------------------------------

Route::get('admin-view_log/{offset?}', function($page = 1) {

	//We make sure that user is logged in.
	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');
	
	//If user is not admin we redirect away.
	if(!Auth::user()->admin) return Redirect::to('/');

	return Redirect::action('AccessLogsController@index', array($page));
});

Route::get('admin-view-logs/{offset?}', 'AccessLogsController@index');

Route::get('admin-ptypes', function() {

		if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

	    //If user is not admin we redirect away.
		if(!Auth::user()->admin) return Redirect::to('/');

		$cart_data = new CartItem;
		list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

		$p_types = DB::select('SELECT id, type_name FROM productTypes WHERE parent_id = ? ORDER BY id DESC', array(0));
	    
	    return View::make('admin.manage_ptypes', array('cart_items_count' => $cart_items_count,
				                                          'total' => $total,
				                                  'cart_products' => $cart_products,
				                                  	  'p_types'  => $p_types
				                                  ));
});

Route::get('add-product', function() {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

    //If user is not admin we redirect away.
	if(!Auth::user()->admin) return Redirect::to('/');

	$cart_data = new CartItem;
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	$p_types = DB::select('SELECT id, type_name FROM productTypes WHERE parent_id = ? ORDER BY id DESC', array(0));
	    
	return View::make('admin.add_product', array('cart_items_count' => $cart_items_count,
				                                          'total' => $total,
				                                  'cart_products' => $cart_products,
				                                  	  'p_types'  => $p_types
				                                  ));
});

Route::get('update-product/{offset_1?}/{offset_2?}/{type?}', function($page_1 = 1, $page_2 = 1, $type = 'Dvd') {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

    //If user is not admin we redirect away.
	if(!Auth::user()->admin) return Redirect::to('/');

	return Redirect::action('ManageProductsController@index', array($page_1, $page_2, $type));

	
});

Route::get('admin-update-products/{offset_1?}/{offset_2?}/{type?}', 'ManageProductsController@index');

Route::get('update-single-product/{id?}/{type?}', function($id = null, $type = null) {

	if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

    //If user is not admin we redirect away.
	if(!Auth::user()->admin) return Redirect::to('/');

	return Redirect::action('UpdateProductController@index', array($id, $type)); 
}); 

Route::get('update-single/{id?}/{type?}', 'UpdateProductController@index');


//----------------------- END Admin routes --------------------------------------------------

//----------------------- Routes With CSRF Filter -------------------------------------------

Route::group(array('before' => 'csrf'), function()
{
	Route::post('handle-login', array('as' => 'login', function() {
	
	$data = Input::all();

	//$user = new User;
	

	$rules = array( 'email' => 'required|email|exists:users,email',
					'password' => 'required'
					);

	$validator = Validator::make($data, $rules);

	if ( $validator->passes() )
	{
		$email = $data['email'];
		$password = $data['password'];
	
		if ( Auth::attempt(array('email' => $email, 'password' =>  $password))) 
		{
			//Logged flag is set to 1
			//$user = User();

			DB::update('UPDATE users SET logged = 1 WHERE email LIKE ?', array( Auth::user()->email ));

			//$user->touch();

			Redirect::to('account');
		}

		return Redirect::to('login')->with('wrong_password','The selected password is incorrect!')->withInput(Input::except('password'));
		
	}

	return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));


	}));

	//we validate registration data. If ok, data is saved in signups table and email is sent to new member.
	Route::post('handle-registration', array('as' => 'register', function() {
		
		$data = Input::all();

		$rules = array( 'email' => 'required|unique:users,email|confirmed|email',
			            'firstname' => 'required|alpha|min:3',
					    'lastname' => 'required|alpha|min:3',
					    'password' => 'required|confirmed|alpha_num|min:6'
					    );

		$validator = Validator::make($data, $rules);

		//$errors = $validator->messages();
		
		if ( $validator->passes() )
		{
			//We save post data to signups table and send email to new member for confirmation.
			$signup = new Signup;
			$signup->email = $data['email'];
			$signup->password = Hash::make( $data['password'] );
			$signup->firstname = $data['firstname'];
			$signup->lastname = $data['lastname'];
	        // Seed random number generator
			srand((double)microtime() * 1000000);
			$conf_code =  md5( $data['email'] . time() . rand(1, 1000000));
			$signup->confirm_code = $conf_code;
			$signup->save();

			
	        //We send confirmation email to new member. 
			Mail::queue('emails.confirmation', array( 'conf_code' => $conf_code ) , function($message)
			{
			    $message->to( Input::get('email'), Input::get('lastname'))->subject('Confirmation');
			});
			
			return Redirect::to('generic-view');
		}
	    //else we redirect to registration form
		return Redirect::to('registration')->withErrors($validator)->withInput(Input::except('password'));
	}));

	
	Route::post('handle-admin-ptypes', array('as' => 'ptypes', function() {

		if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

		//If user is not admin we redirect away.
		if(!Auth::user()->admin) return Redirect::to('/');

		$data = Input::all();
		
		$p_type = new ProductType;
		$p_type->parent_id = $data['parent_id'];
		$p_type->type_name = $data['type_name'];
		$p_type->save();

		return Redirect::to('admin-ptypes');	


	}));

	Route::post('handle-add-product', array('as' => 'insert_prod', function() {

		if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

		//If user is not admin we redirect away.
		if(!Auth::user()->admin) return Redirect::to('/');

		$data = Input::all();
		
		$product = new Product;
		$product->product_type = $data['product_type'];
		$product->product_name = $data['product_name'];
		$product->product_price = $data['price'];
		$product->product_language = $data['language'];
		$product->product_description = $data['description'];
		$product->product_author = $data['author'];
		$product->product_isbn10 = $data['isbn'];
		$product->save();

    	$pdo = DB::connection()->getPdo();
    	$id = $pdo->lastInsertId();
		
		$trailer = new Trailer;
		$trailer->movie_id = $id;
		$trailer->code = $product['trailer'];
		$trailer->save();
         
        $name = $product->id.'.jpg';

        if ( Input::hasFile('cover') )
        {
        	Input::file('cover')->move('images/products_images', $name);
        } 
		


		return Redirect::to('add-product')->with('add_success', 'Product added successfully!');	


	}));

	Route::post('update-product-db', function() {


		if(!Auth::check()) return Redirect::to('login')->with('not_logged', 'You should be logged in!');

		//If user is not admin we redirect away.
		if(!Auth::user()->admin) return Redirect::to('/');

		$data = Input::all();

		DB::update('UPDATE products SET product_name = ?, product_price = ?, product_language = ?, product_type = ?,
										product_description = ?, product_author = ?, product_isbn10 = ?, updated_at = ?
										WHERE id = ?', 
										array(
												$data['product_name'], $data['product_price'], $data['product_language'], $data['product_type'],
												$data['product_description'], $data['product_author'], $data['product_isbn10'], 'CURRENT_TIMESTAMP', $data['prodId']	
										));

		$oldCover = 'images/products_images/'.$data['prodId'].'.jpg';
		$cover = $data['prodId'].'.jpg';

		if ( Input::hasFile('cover') )
        {
        	if (file_exists($oldCover))
        		unlink($oldCover);
        	
        	Input::file('cover')->move('images/products_images', $cover);
        }

        if (Input::has('trailer'))
        {
        	$code = Input::get('trailer');

        	DB::update('UPDATE trailers SET code = ?, updated_at = ? WHERE movie_id = ?', array($code, 'CURRENT_TIMESTAMP', $data['prodId']));
        } 

        $token = Input::get('type_token'); 
        $id = Input::get('prodId');
		return Redirect::action('UpdateProductController@index', array($id, $token))->with('update_success', 'Product updated successfully!');

	});

	Route::post('remove-logs', function() {

		$data = Input::all();

		unset($data['_token']);

		/*$logId = array();
		foreach ($data as $key => $value)
			$logId[] = $value;*/

		foreach ($data as $key => $value)
			DB::delete('DELETE FROM accessLogs WHERE id = ?', array($value));

		return Redirect::to('admin-view_log');

	});

});

//---------------------- END Routes With CSRF Filter--------------------------------------------------

Route::get('cart-index', function() {

	if(Auth::check()) return Redirect::to('open-orders');

	$cart_data = new CartItem;

	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('cart.index', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
});

Route::get('generic-view', function () {
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('generic', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
});



App::missing(function($exception)
{
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

    return Response::view('errors.missing', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products), 404);
});

Route::get('not_found', function() {

	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

    return Response::view('errors.missing', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                               ));	
});


Route::get('projects', function() {

	return View::make('projects.projects');
});




Route::get('testing', function() {

	//$var = DB::select('SELECT * FROM signups');
	$var = get_browser(null);
	return $var->parent.' '.$var->platform;
});

Route::get('redis', function() {

	$movies = DB::select('SELECT * FROM products WHERE product_type = ?', array(11));
	$ebooks = DB::select('SELECT * FROM products WHERE product_type = ?', array(10));
	
	$redis = Redis::connection();

	
    //$redis->flushdb(0);

	foreach ( $movies as $movie )
	{	
		$redis->lpush('movies_id', $movie->id );  		
		$redis->hmset('movies:'.$movie->id, 'id', $movie->id, 'type', $movie->product_type, 'name', $movie->product_name, 'description', $movie->product_description);
	}	

	foreach ( $ebooks as $ebook )
	{	
		$redis->lpush('ebooks_id', $ebook->id ); 		
		$redis->hmset('ebooks:'.$ebook->id, 'id', $ebook->id, 'type', $ebook->product_type, 'name', $ebook->product_name, 'description', $ebook->product_description);
	}	


	//$ebook_data = array();
	/*	
	for ($i = 0; $i < sizeof($ebooks_id); $i++)
	{
		$data[] = Redis::hgetall("ebooks:$ebooks_id[$i]");
	}
	*/
	return $redis->llen('movies_id').', '.$redis->llen('ebooks_id');
	return 'Redis: hashes ready!';

});