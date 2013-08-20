<?php



Route::get('/', 'HomeController@index');



Route::get('movies/{offset?}', 'MoviesController@index');

Route::get('ebooks/{offset?}', 'EbooksController@index');

Route::get('add_to_cart/{product_id}/{uri?}', 'CartController@add_item');

Route::get('empty_cart/{uri?}', 'CartController@empty_cart');

Route::get('login', function() {
	
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('login.index', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products ));
});

Route::post('handle-login', array('before' => 'csrf', 'as' => 'login', function() {
	$email =  Input::get('email');
	$passwd =  md5( Input::get('password') );

	return 'email = '.$email.', password = '.$passwd;
}));

Route::post('handle-registration', array('before' => 'csrf','as' => 'register', function() {
	
	$data = Input::all();

	$rules = array( 'email' => 'required|unique:signups,email|confirmed|email',
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
		$signup->password = md5($data['password']);
		$signup->firstname = $data['firstname'];
		$signup->lastname = $data['lastname'];
        // Seed random number generator
		srand((double)microtime() * 1000000);
		$signup->confirm_code = md5( $data['email'] . time() . rand(1, 1000000));
		$signup->save();

		return Redirect::to('generic-view')->with('message', 'You signed up successfully! Check your email for confirmation.');
	}

	return Redirect::to('registration')->withErrors($validator)->withInput(Input::except('password'));
}));

Route::get('registration', function() {
	
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('login.register', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products
			                                  ));
});

Route::get('generic-view', function ($message = '') {
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('generic', array('cart_items_count' => $cart_items_count,
			                                          'total' => $total,
			                                  'cart_products' => $cart_products,
			                                  'message' => $message
			                           ));
});