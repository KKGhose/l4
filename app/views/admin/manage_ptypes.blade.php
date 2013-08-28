@extends('layouts.master')

@section('head')
@parent
@stop

@section('content')
<!-- NAVBAR
================================================== -->
 <div class="navbar-wrapper">
   <div class="container">

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

                <li><a data-toggle="modal" href="#Cart_Modal"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;
                @if ($cart_items_count == 0 || $cart_items_count > 1)
                   Cart (you have {{$cart_items_count}} items)</a></li>
                @else
                   Cart (you have {{$cart_items_count}} item)</a></li>
                @endif  
              
                <ul class="nav navbar-nav"> 
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i>&nbsp;&nbsp;Your Account  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                   @if ( !Auth::check() )
                    <li><a href="{{url('login')}}"><i class="icon-signin"></i>&nbsp;&nbsp;<strong>Login</strong></a></li>
                   @else
                    <li><a href="{{url('logout')}}"><i class="icon-off"></i>&nbsp;&nbsp;<strong>Logout</strong></a></li>
                   @endif 
                    <li><a href="{{url('account')}}"><i class="icon-cog"></i>&nbsp;&nbsp;<strong>Profile</strong></a></li>
                    <li><a href="#"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;<strong>Cart</strong></a></li>
                  </ul>
                </li> 
                    @if (Auth::check())
                      <p class="navbar-text pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('logout')}}"><i class="icon-off"></i>&nbsp;Logout</a>&nbsp;&nbsp;
                      ( Signed in as {{Auth::user()->firstname}} ) 
                     </p>
                    @else
                      <p class="navbar-text pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('login')}}"><i class="icon-signin"></i>&nbsp;Login</a>&nbsp;&nbsp; 
                    @endif              
                </ul>
                
              </ul>
            </div>
          </div>
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
                           @if ($cart_product->product_type == 2)
                             {{'<i class="icon-film"></i>&nbsp;&nbsp<strong>'.$cart_product->product_name.'</strong>&nbsp;&nbsp;<small><em class="muted">x '.$cart_product->quantity.'</em></small>'}}
                           @else
                             {{'<i class="icon-book"></i>&nbsp;&nbsp<strong>'.$cart_product->product_name.'</strong>&nbsp;&nbsp;<small><em class="muted">x '.$cart_product->quantity.'</em></small>'}}
                           @endif  
                          </li>
                          @endforeach
                          <li>&nbsp;</li>
                          <li><strong>Total:</strong> {{$total}}</li>
                          <li>&nbsp;</li>
                          <li><button type="button" class="btn btn-primary btn-xs">View Cart In Details</button>&nbsp;&nbsp;
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
<h3><i class="icon-wrench icon-2x"></i>&nbsp;&nbsp;Admin Menu / Manage Product Types</h3><br />

<div class="row">
	
  
  <div class="col-lg-9">

     <form action="{{route('ptypes')}}" method="post" class="form-horizontal" role="form"> 
       
       {{ Form::token() }}

     <div class="form-group">
       <label for="parent_id" class="col-lg-3 control-label">Parent product type</label>         
       <div class="col-lg-4">
          <select name="parent_id" class="form-control">
            <option value="0">none</option>
            @foreach ($p_types as $p_type)
              <option value="{{$p_type->id}}">{{$p_type->type_name}}</option>
            @endforeach
          </select>
      </div>
     </div>               
       
     <div class="form-group">
       <label for="type_name" class="col-lg-3 control-label">New product type</label> 
      <div class="col-lg-4">    
        <input type="text" class="form-control" name="type_name" id="type_name" placeholder="Enter new type name">                              
       </div>
     </div>

      <div class="form-group"> 
      <div class="col-lg-offset-3 col-lg-9">  
        <button type="submit" class="btn btn-default">Add new product type</button>              
      </div>
     </div>
     </form>
      

   </div>
       
    <div class="col-lg-3">    
        <ul class="nav nav-pills nav-stacked">
          <li><a href="{{url('account')}}">Home</a></li>
          <li><a href="#">Manage Users</a></li>
          <li class="active"><a href="{{url('admin-ptypes')}}">Manage Product Types</a></li>
          <li><a href="#">Add Product</a></li>
          <li><a href="#">Update or Remove Product</a></li>
          <li><a href="#">Manage Orders</a></li>
          <li><a href="{{url('admin-view_log')}}">View Access Log</a></li>
          <li><a href="{{url('logout')}}">Logout</a></li>
        </ul>
    </div>
   
</div> <!-- Row -->



<hr class="featurette-divider">

@stop