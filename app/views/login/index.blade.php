@extends('layouts.master')

@section('head')
@parent
@stop

@section('content')
<!-- NAVBAR
================================================== -->
 
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="{{url()}}">Online Store</a>
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="{{url()}}"><i class="icon-home icon-white"></i>&nbsp;&nbsp;Home</a></li>
                <li><a href="{{url('movies')}}"><i class="icon-film icon-white"></i>&nbsp;&nbsp;Movies</a></li>
                <li><a href="{{url('ebooks')}}"><i class="icon-book icon-white"></i>&nbsp;&nbsp;Ebooks</a></li>
                <li><a href="#contact"><i class="icon-envelope icon-white"></i>&nbsp;&nbsp;Contact</a></li>

                {{--If cart is empty we don't activate the link--}}
                @if (!$cart_products)
                   <li><a href="#"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;Cart (you have 0 items)</a></li>
                @else   
                    <li><a data-toggle="modal" href="#Cart_Modal"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;
                    @if ($cart_items_count == 1)
                       Cart (you have {{$cart_items_count}} item)</a></li>
                    @else
                       Cart (you have {{$cart_items_count}} items)</a></li>
                    @endif
                @endif    
                </ul>

                <ul class="nav navbar-nav pull-right"> 
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i>&nbsp;&nbsp;Your Account  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                   @if ( !Auth::check() )
                    <li><a href="{{url('login')}}"><i class="icon-signin"></i>&nbsp;&nbsp;<strong>Login</strong></a></li>
                   @else
                    <li><a href="{{url('logout')}}"><i class="icon-off"></i>&nbsp;&nbsp;<strong>Logout</strong></a></li>
                   @endif 
                    <li><a href="{{url('account')}}"><i class="icon-cog"></i>&nbsp;&nbsp;<strong>Profile</strong></a></li>
                    <li><a href="{{url('cart-index')}}"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;<strong>Cart</strong></a></li>
                  </ul>
                </li> 
                </ul>
              </ul>
            </div>
          </div>
        </div>

     

    <!-- Cart Modal -->
                    <div class="modal fade" id="Cart_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;My Cart</h4>
                          </div>
                          <div class="modal-body">
                          <ul class="list-unstyled">
                          @foreach ($cart_products as $cart_product)
                          <li>
                           @if ($cart_product->type_name == 'Dvd')
                             {{'<i class="icon-film"></i>&nbsp;&nbsp<strong>'.$cart_product->product_name.'</strong>&nbsp;&nbsp;<small><em class="muted">x '.$cart_product->quantity.'</em></small>'}}
                           @else
                             {{'<i class="icon-book"></i>&nbsp;&nbsp<strong>'.$cart_product->product_name.'</strong>&nbsp;&nbsp;<small><em class="muted">x '.$cart_product->quantity.'</em></small>'}}
                           @endif  
                          </li>
                          @endforeach
                          <li>&nbsp;</li>
                          <li><strong>Total:</strong> {{$total}}</li>
                          <li>&nbsp;</li>
                          <li><a href="{{url('cart-index')}}" type="button" class="btn btn-primary btn-xs">View Cart In Details
                          </a>&nbsp;&nbsp;
                          <a href="{{url('empty_cart')}}/ebooks" type="button" class="btn btn-danger btn-xs"><i class="icon-trash"></i>&nbsp;&nbsp;Empty Cart</a></li>
                         </ul>
                          
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

  <!-- CAROUSEL
================================================== -->
<div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{url()}}/images/products_images/linux3_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{url()}}/images/products_images/inception3_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        
       </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

    <!-- CONTAINER
================================================== -->
<div class="container marketing">


<div class="row">
	<h1><i class="icon-signin"></i>&nbsp;Login</h1><br />
  
      <div class="col-lg-4"></div>
	      <div class="col-lg-4">
            <div class="well">

       @foreach($errors->all() as $message)
			   <div class="alert alert-danger">
              <strong>Warning!</strong> {{$message}}
         </div>
		    @endforeach

      @if ( Session::has('wrong_password') )
        <div class="alert alert-danger">
            <strong>Warning!</strong> {{Session::get('wrong_password')}}
        </div>
      @endif

			{{ Form::open( array( 'route' => 'login',
					              'class' => 'form-signin') )}}
      
      @if ( Session::has('success_message') )
        <div class="alert alert-success">
            <strong>Well done!</strong> {{Session::get('success_message')}}
        </div>
      @endif

      @if (Session::has('not_logged'))
      <div class="alert alert-warning">
          <strong>Warning!</strong> {{Session::get('not_logged')}}
      </div>
      @endif

			<h2 class="form-signin-heading">Please sign in</h2>
			<br />
      
      @if ( Session::has('email') )
			{{ Form::email('email', Session::get('email'), array('class' => 'form-control',
									    'placeholder' =>  'Email address' 
									    ))}}		
       @else
       {{ Form::email('email', '', array('class' => 'form-control',
                      'placeholder' =>  'Email address' 
                      ))}}    
       @endif               
			<br />

			{{ Form::password('password', array( 'class' => 'form-control',
										   'placeholder' =>  'Password' ))}}      
			<br />
										   	
			{{ Form::submit('Sign in', array('class' => 'btn btn-large btn-primary btn-block'))}}      
			
			{{ Form::close() }}
           
           </div>
         </div>
    <div class="col-lg-4"></div>
</div> <!-- Row -->

	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
         <div class="well">   
          <a href="{{url('registration')}}" class="btn btn-link">
          <strong><i class="icon-exclamation-sign icon-2x"></i>&nbsp;New customer?</strong>&nbsp;Start Here
          </a>
        </div>
   
        </div>
    <div class="col-lg-4"></div>
	</div><!-- row -->

<hr class="featurette-divider">

@stop