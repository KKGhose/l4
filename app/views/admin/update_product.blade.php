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
                          <li><a href="{{url('cart-index')}}" type="button" class="btn btn-primary btn-xs">View Cart In Details</a>&nbsp;&nbsp;
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
              <li><h3><i class="icon-wrench"></i>&nbsp;Admin Menu</h3></li>
              <li><a href="{{url('account')}}">Home</a></li>
              <li><a href="{{url('admin-ptypes')}}">manage product types</a></li>
              <li><a href="{{url('add-product')}}">add product</a></li>
              <li class="active"><a href="{{url('update-product')}}">update or remove product</a></li>
              <li><a href="#">manage orders</a></li>
              <li><a href="{{url('admin-view_log')}}">view access logs</a></li>
              <li><a href="#">remove access logs</a></li>
              <li><a href="{{url('logout')}}">logout</a></li>
        </ul>
      </div>     
  </div>     

 <div class="col-lg-9">

  <ul class="nav nav-tabs">
  @if ($type == 'Dvd')
    <li class="active"><a href="#movies" data-toggle="tab"><i class="icon-film"></i>&nbsp;Movies</a></li>
    <li><a href="#ebooks" data-toggle="tab"><i class="icon-book"></i>&nbsp;Ebooks</a></li>
  @elseif ($type == 'Book')
    <li><a href="#movies" data-toggle="tab"><i class="icon-film"></i>&nbsp;Movies</a></li>
    <li class="active"><a href="#ebooks" data-toggle="tab"><i class="icon-book"></i>&nbsp;Ebooks</a></li>
  @endif    
    
  </ul>

<div class="tab-content">

 @if ($type == 'Dvd') 
  <div class="tab-pane active" id="movies">
 @else
  <div class="tab-pane" id="movies">
 @endif  
    <br>  
      <div class="row">    
        @foreach ($movies as $movie)

          <div class="col-sm-2 col-md-2">
            <a href="{{url('update-single-product')}}/{{$movie->id}}/{{$movie->type_name}}"  data-toggle="tooltip" title="{{$movie->product_name}}" class="thumbnail">
             <div class="clearfix">
              <input type="image" class="img-rounded" value="submit" src="{{url()}}/images/products_images/{{$movie->id.'.jpg'}}" height="160" width="100">
             </div>
            </a>
          </div>

        @endforeach
   </div> 

      {{--Movies Pagination--}}
          <div class="row">
          
          <div class="col-lg-3"></div>
            <div class="col-lg-4">
              <ul class="pagination pagination-lg">
                @if ($moviesNumPages == 1)
              <li class="disabled"><span>Prev</span></li>
            @else
               <li><a href="{{url('update-product')}}/{{$moviePage - 1}}/1">Prev</a></li>
            @endif     
               @for ($i = 1; $i <= $moviesNumPages; $i++)
                  @if ($moviePage == $i) 
                  <li class="disabled"><span>{{ $i }}</span></li>
                  @else
                    <li><a href="{{url('update-product')}}/{{$i}}/1">{{ $i }}</a></li>
                  @endif    
               @endfor
            @if ($moviePage == $moviesNumPages)   
              <li class="disabled"><span>Next</span></li>
            @else
              <li><a href="{{url('update-product')}}/{{$moviePage + 1}}/1">Next</a></li>
            @endif  
            </ul>
          </div>
         

        </div>
      {{--End Movies Pagination--}}

  </div>
  
 @if ($type == 'Book')   
  <div class="tab-pane active" id="ebooks">
 @else
   <div class="tab-pane" id="ebooks">
 @endif 
     <br>  
      <div class="row">    
        @foreach ($ebooks as $ebook)
      
          <div class="col-sm-2 col-md-2">
            <a href="{{url('update-single-product')}}/{{$ebook->id}}/{{$ebook->type_name}}" class="thumbnail" data-toggle="tooltip" title="{{$ebook->product_name}}" >
             <div class="clearfix">
              <input type="image" class="img-rounded" value="submit" src="{{url()}}/images/products_images/{{$ebook->id.'.jpg'}}" height="160" width="100">
             </div>
            </a>
          </div>     
         
        @endforeach
   </div>
   {{--eBooks Pagination--}}
          <div class="row">
          
          <div class="col-lg-3"></div>
            <div class="col-lg-4">
              <ul class="pagination pagination-lg">
                @if ($ebooksNumPages == 1)
              <li class="disabled"><span>Prev</span></li>
            @else
               <li><a href="{{url('update-product')}}/1/{{$ebookPage - 1}}/Book">Prev</a></li>
            @endif     
               @for ($ii = 1; $ii <= $ebooksNumPages; $ii++)
                  @if ($ebookPage == $ii) 
                  <li class="disabled"><span>{{ $ii }}</span></li>
                  @else
                    <li><a href="{{url('update-product')}}/1/{{$ii}}/Book">{{ $ii }}</a></li>
                  @endif    
               @endfor
            @if ($ebookPage == $ebooksNumPages)   
              <li class="disabled"><span>Next</span></li>
            @else
              <li><a href="{{url('update-product')}}/1/{{$ebookPage + 1}}/Book">Next</a></li>
            @endif  
            </ul>
          </div>
         

        </div>
      {{--End eBooks Pagination--}}        
  </div>
</div> <!-- //tab-content -->

</div>
    
   
</div> <!-- Row -->

<hr class="featurette-divider">

@stop