@extends('layouts.master')

@section('head')
@parent
{{ HTML::style('css/modal_img.css') }}
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
                    @if (Auth::check())
                      <p class="navbar-text pull-right">
                      <a href="{{url('logout')}}"><i class="icon-off"></i>&nbsp;Logout</a>
                      ( Signed in as {{Auth::user()->firstname}} ) 
                     </p>
                    @else
                      <p class="navbar-text pull-right">
                      <a href="{{url('login')}}"><i class="icon-signin"></i>&nbsp;Login</a>
                      </p>
                    @endif 
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
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="{{url()}}/images/products_images/laravel_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              
              <p></p>
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

    <div class="col-lg-3"> 
       <div class="well">  
        <ul class="nav nav-pills nav-stacked">
          <li><h3><i class="icon-user"></i>&nbsp;My Account</h3></li>
          <li><a href="{{url('account')}}">Home</a></li>
          <li><a href="{{url('open-orders')}}">View open orders</a></li>
          <li class="active"><a href="{{url('change-account')}}">Change account settings</a></li>
          <li><a href="{{url('logout')}}">Logout</a></li>
        </ul>
        </div>
      </div>

	    <div class="col-lg-9">
      
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a href="#info" data-toggle="tab"><i class="icon-male"></i>&nbsp;Change Personal Info</a></li>
          <li><a href="#password" data-toggle="tab"><i class="icon-lock"></i>&nbsp;Change Password</a></li>
          <li><a href="#address" data-toggle="tab"><i class="icon-home"></i>&nbsp;Change Address</a></li>
        </ul>

        <div class="tab-content">
        
        @if (Session::get('tab') == 'info')  
            <div class="tab-pane active" id="info">
        @else
            <div class="tab-pane" id="info">
        @endif    
        <br /><br />
          <form action="{{url('update-account-info')}}" method="post" class="form-horizontal" role="form">

            @if ( Session::has('update_success') )
              <div class="alert alert-success">
                  <strong>Well done!</strong> {{Session::get('update_success')}}
              </div>
            @endif

            {{ Form::token() }}

            <input type="hidden" name="userId" value="{{$user->id}}">
            <input type="hidden" name="tab" value="info">

            <div class="form-group">
             <label for="email" class="col-lg-3 control-label">My Email Is(*):</label> 
                <div class="col-lg-4">    
                <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly="readonly">           
                </div>
           </div>

           <div class="form-group">
             <label for="firstname" class="col-lg-3 control-label">My Firstname Is(*):</label> 
                <div class="col-lg-4">    
                <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}">           
                </div>
           </div>  

           <div class="form-group">
             <label for="lastname" class="col-lg-3 control-label">My Lastname Is(*):</label> 
                <div class="col-lg-4">    
                <input type="text" class="form-control" name="lastname" value="{{$user->lastname}}">           
                </div>
           </div>  

           <div class="form-group"> 
            <label for="submit" class="col-lg-3 control-label"></label> 
              <div class="col-lg-3">  
                <button type="submit" class="btn btn-danger"><i class="icon-pencil"></i>&nbsp;Update Personal Info</button>              
              </div>
           </div>

          </form> 

        </div>
          
          <div class="tab-pane" id="password">
          Hello password</div>
          
          <div class="tab-pane" id="address">
          Hello address</div>
        </div>
      
      </div> <!-- Row -->

<div class="row">
<div class="col-lg-12">
 <hr class="featurette-divider">
</div>
</div>

@stop