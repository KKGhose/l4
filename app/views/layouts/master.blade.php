<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel 4 project 2013</title>
    @section('head')
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/carousel.css') }}
      
    <!-- Font-Awesome CDN-->  
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
     @show 
  </head>
<!-- NAVBAR
================================================== -->
  <body>

  @section('navbar')
  <div class="navbar-wrapper">
   <div class="container">

        <div class="navbar navbar-inverse navbar-static-top">
          <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#">Online Store</a>
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#"><i class="icon-home icon-white"></i>&nbsp;&nbsp;Home</a></li>
                <li><a href="{{$base_url}}/movies"><i class="icon-film icon-white"></i>&nbsp;&nbsp;Movies</a></li>
                <li><a href="#about"><i class="icon-book icon-white"></i>&nbsp;&nbsp;Ebooks</a></li>
                <li><a href="#contact"><i class="icon-envelope icon-white"></i>&nbsp;&nbsp;Contact</a></li>

              
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i>&nbsp;&nbsp;Your Account  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-signin"></i>&nbsp;&nbsp;<strong>Login</strong></a></li>
                    <li><a href="#"><i class="icon-cog"></i>&nbsp;&nbsp;<strong>Profile</strong></a></li>
                    <li><a href="#"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;<strong>Cart</strong></a></li>
                  </ul>
                </li> 
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
    @show

<!-- Carousel
    ================================================== --> 
    @section('carousel')
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="{{$base_url}}/js/holder.js/1500x500/auto/#777:#7a7a7a/text:Powered by Laravel 4" alt="">
          <!--img data-src="{{$base_url}}/js/holder.js/1500x500/auto/#777:#F0F0F0/text:Powered by Laravel 4" alt=""-->
          <div class="container">
            <div class="carousel-caption">
              <h1>Welcome To The Online Store Version 2.0!</h1>
              <p>It's a new dawn for the PHP world (and for me as well ;))! with the advent of <a href="http://laravel.com/">Laravel 4</a>, a popular PHP framework heavily inspired by the likes of Ruby on Rails, as well as other modern PHP frameworks like Symfony. As you can guess I'm integrating my site to this new environment. It has been a very pleasurable experience so far, mainly because I enjoy the workflow and the numerous features of Laravel 4, and I strongly suggest that PHP web developers have a go at it! (Project started 05.08.2013)</p>
              <p><a class="btn btn-large btn-primary" href="#">Sign up today</a></p>
            </div>
          </div>
        </div>
        
        <div class="item">
          <img src="{{$base_url}}/images/products_images/inception3_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>

        <div class="item">
          <img src="{{$base_url}}/images/products_images/breakingbad_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>


        <div class="item">
          <img src="{{$base_url}}/images/products_images/inception4_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
            </div>
          </div>
        </div>

        <div class="item">
          <img src="{{$base_url}}/images/products_images/inception2_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>      
      
      
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
    @show

  
  <div class="container marketing">

  @yield('content')

  <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 Online Store, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

  </div><!-- /.container -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     {{ HTML::script('js/jquery-1.10.2.min.js') }}
     {{ HTML::script('js/bootstrap.js') }}
     {{ HTML::script('js/holder.js') }}
  
  </body>
</html>