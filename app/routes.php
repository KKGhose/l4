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
			                                  'cart_products' => $cart_products
			                                  ));
});

Route::post('handle-login', array('before' => 'csrf', 'as' => 'login', function() {
	
	$data = Input::all();

	$rules = array( 'email' => 'required|email',
					'password' => 'required'
					);

	$validator = Validator::make($data, $rules);

	if ( $validator->passes() )
	{
		return '<h1>Work in progress!</h1>';
	}

	return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));


}));

//we validate registration data. If ok, data is saved in signups table and email is sent to new member.
Route::post('handle-registration', array('before' => 'csrf','as' => 'register', function() {
	
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
		$signup->password = md5($data['password']);
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

Route::get('registration', function() {
	
	$cart_data = new CartItem;
	
	list( $cart_products, $cart_items_count, $total ) = $cart_data->get_cart_data();

	return View::make('login.register', array('cart_items_count' => $cart_items_count,
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

//This route is accessed through confirmation email sent to new member.
//Upon firing the the new member data is transfered form signups table to users table.
Route::get('confirm/{code?}', function($code = null) {

	$signups = DB::select('SELECT email, password, firstname, lastname FROM signups WHERE confirm_code LIKE ?', array($code));
	 
	if(!$signups) return Redirect::to('not_found'); 

	foreach($signups as $signup)
	{
		$user = new User;
		$user->email = $signup->email;
		$email = $signup->email;
		$user->password = $signup->password;
		$user->firstname = $signup->firstname;
		$user->lastname = $signup->lastname;
		$user->save();
    }

    DB::delete('DELETE FROM signups WHERE confirm_code LIKE ?', array($code));

	return Redirect::to('login')->with('success_message', 'Your account has been confirmed!')
								->with('email', $email);
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

	return Redirect::to('login')->with('email', 'sguessou@gmail.com');
});