@extends('layouts.master')

@section('head')
@parent
  {{ HTML::style('css/modal_img.css') }}
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
                <li class="active"><a href="{{url('ebooks')}}"><i class="icon-book icon-white"></i>&nbsp;&nbsp;Ebooks</a></li>
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
                    <li><a href="#"><i class="icon-cog"></i>&nbsp;&nbsp;<strong>Profile</strong></a></li>
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
          <img src="{{url()}}/images/products_images/php2_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        
       </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

<div class="container marketing">
<div class="row">
        <h1><i class="icon-book"></i>&nbsp;IT-Ebooks:</h1><br />
        @foreach ($ebooks as $ebook)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{url()}}/images/products_images/{{$ebook->id.'_thumb.jpg'}}">
          <p></p>
          <p><a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$ebook->id}}/ebooks">Add to cart &raquo;</a>&nbsp;&nbsp;
          <a data-toggle="modal" href="#myModal_{{$ebook->id}}" class="btn btn-default">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->

        {{-- Start Modal --}}
          <!-- Modal -->
      <div class="modal fade" id="myModal_{{$ebook->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title"><i class="icon-book"></i>&nbsp;{{$ebook->product_name}}</h3>
            </div>
            <div class="modal-body">
             <h4>Ebook Description</h4><br />
            <div class="twist_img">
          <img src="{{url()}}/images/products_images/{{$ebook->id}}_thumb.jpg">
          <p>{{$ebook->product_description}}</p>
          </div><br />
          <h4>Ebook Details</h4><br />
            <ul>
              <li><strong>Language:</strong>&nbsp;{{$ebook->product_language}}</li>  
              <li><strong>ISBN-10:</strong>&nbsp;{{$ebook->product_isbn10}}</li>
              <li><strong>Price:</strong>&nbsp;{{$ebook->product_price}}&nbsp;&euro;</li>
            </ul>
          </div>
            <div class="modal-footer">
              <a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$ebook->id}}/ebooks">Add to cart &raquo;</a>&nbsp;&nbsp;
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
          {{-- End Modal --}}

        @endforeach
      </div><!-- /.row -->

     <div class="row">
      <div class="col-lg-4"></div>
	      <div class="col-lg-4">
		      <ul class="pagination pagination-lg">
		        @if ($page == 1)
				  <li class="disabled"><span>Prev</span></li>
				@else
				   <li><a href="{{url('ebooks')}}/{{$page - 1}}">Prev</a></li>
				@endif     
				   @for ($i = 1; $i <= $num_pages; $i++)
				   	  @if ($page == $i)	
				  		<li class="disabled"><span>{{ $i }}</span></li>
				  	  @else
				  	  	<li><a href="{{url('ebooks')}}/{{$i}}">{{ $i }}</a></li>
				  	  @endif		
				   @endfor
				@if ($page == $num_pages)   
				  <li class="disabled"><span>Next</span></li>
				@else
				  <li><a href="{{url('ebooks')}}/{{$page + 1}}">Next</a></li>
				@endif  
			  </ul>
		  </div>
	   <div class="col-lg-4"></div>
	  </div>


	 

	  <hr class="featurette-divider">
	  
@stop