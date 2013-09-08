@extends('layouts.master')

@section('head')
@parent
  {{ HTML::style('css/modal_img.css') }}
@stop

@section('content')

  <!-- NAVBAR
================================================== -->

        <nav class="navbar navbar-inverse navbar-fixed-top"  role="navigation"> 
          <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="{{url()}}">Online Store</a>
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="{{url()}}"><i class="icon-home icon-white"></i>&nbsp;&nbsp;Home</a></li>
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
        </nav>

      
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
                          <li><strong>Total:</strong> {{$total}}&nbsp;<i class="icon-euro"></i></li>
                          <li>&nbsp;</li>
                          <li><a href="{{url('cart-index')}}" type="button" class="btn btn-primary btn-xs">View Cart In Details</button>&nbsp;&nbsp;</a>
                          <a href="{{url('empty_cart')}}" type="button" class="btn btn-danger btn-xs"><i class="icon-trash"></i>&nbsp;&nbsp;Empty Cart</a></li>
                         </ul>
                          
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


    <!-- Carousel
    ================================================== --> 
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="js/holder.js/1500x500/auto/#777:#7a7a7a/text:Powered by Laravel 4" alt="">
         
          <div class="container">
            <div class="carousel-caption">
              <h1>Welcome To The Online Store Version 2.0!</h1>
              <p>It's a new dawn for the PHP world (and for me as well ;))! with the advent of <a href="http://laravel.com/">Laravel 4</a>, a popular PHP framework heavily inspired by the likes of Ruby on Rails, as well as other modern PHP frameworks like Symfony. As you can guess I'm integrating my site to this new environment. It has been a very pleasurable experience so far, mainly because I enjoy the workflow and the numerous features of Laravel 4, and I strongly suggest that PHP web developers have a go at it! (Project started 05.08.2013)</p>
              <p><a class="btn btn-large btn-primary" href="#">Sign up today</a></p>
            </div>
          </div>
        </div>
        
        <div class="item">
          <img src="{{url()}}/images/products_images/inception3_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>

        <div class="item">
          <img src="{{url()}}/images/products_images/laravel_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>


        <div class="item">
          <img src="{{url()}}/images/products_images/inception_ex_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>

        
      </div>      
      
      
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    
    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <h1><i class="icon-film"></i>&nbsp;New From DVD Movies:</h1><br />
        @foreach ($movies as $movie)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{url()}}/images/products_images/{{$movie->id.'.jpg'}}" height="300" width="200">
          <h2>{{$movie->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $movie->product_description), 0, 20) ).'...' }}</p>
          <p><a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$movie->id}}">Add to cart &raquo;</a>&nbsp;&nbsp;
          <a data-toggle="modal" href="#myModal_{{$movie->id}}" class="btn btn-default">View details &raquo;</a></p> 
        </div><!-- /.col-lg-4 -->

        {{-- Start Modal --}}
          <!-- Modal -->
          <div class="modal fade" id="myModal_{{$movie->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3 class="modal-title"><i class="icon-film"></i>&nbsp;{{$movie->product_name}}</h3>
                </div>
                <div class="modal-body">
                 <h4>DVD Description</h4><br />
                <div class="twist_img">
              <img src="{{url()}}/images/products_images/{{$movie->id}}.jpg">
              <p>{{$movie->product_description}}</p>
              
              </div><br />
              <h4>DVD Details</h4><br />
              <ul>
              <li><strong>Language:</strong>&nbsp;{{$movie->product_language}}</li>  
              <li><strong>ISBN-10:</strong>&nbsp;{{$movie->product_isbn10}}</li>
              <li><strong>Price:</strong>&nbsp;{{$movie->product_price}}&nbsp;&euro;</li>
              </ul>
                </div>
                <div class="modal-footer">
                  <a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$movie->id}}">Add to cart &raquo;</a>&nbsp;&nbsp;
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          {{-- End Modal --}}

        @endforeach
      </div><!-- /.row -->

      <hr class="featurette-divider">

      <div class="row">
       <h1><i class="icon-book"></i>&nbsp;New From IT-Ebooks:</h1><br />
        @foreach ($ebooks as $ebook)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{url()}}/images/products_images/{{$ebook->id.'.jpg'}}" height="300" width="200">
          <h2>{{$ebook->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $ebook->product_description), 0, 20) ).'...' }}</p>
          <p><a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$ebook->id}}">Add to cart &raquo;</a>&nbsp;&nbsp;
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
              <img src="{{url()}}/images/products_images/{{$ebook->id}}.jpg">
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
                  <a class="btn btn-primary" href="{{url('add_to_cart')}}/{{$ebook->id}}">Add to cart &raquo;</a>&nbsp;&nbsp;
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          {{-- End Modal --}}

        @endforeach
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" data-src="js/holder.js/512x512">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-left" data-src="js/holder.js/512x512">
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" data-src="js/holder.js/512x512">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    @stop