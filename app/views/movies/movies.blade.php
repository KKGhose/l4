@extends('layouts.master')

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
            <a class="navbar-brand" href="{{$base_url}}">Online Store</a>
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="{{$base_url}}"><i class="icon-home icon-white"></i>&nbsp;&nbsp;Home</a></li>
                <li class="active"><a href="#about"><i class="icon-film icon-white"></i>&nbsp;&nbsp;Movies</a></li>
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
@overwrite

@section('carousel')
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
          <img src="{{$base_url}}/images/products_images/inception4_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{$base_url}}/images/products_images/breakingbad_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="{{$base_url}}/images/products_images/inception3_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
           </div>
          </div>
           <div class="item">
          <img src="{{$base_url}}/images/products_images/inception2_wp.jpg" alt="" width="1100" height="500" alt="">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
       </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

@overwrite


@section('content')

<div class="row">
        <h1><i class="icon-film"></i>&nbsp;DVD Movies:</h1><br />
        @foreach ($movies as $movie)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{$base_url}}/images/products_images/{{$movie->id.'_thumb.jpg'}}" style="width:160;height:220;">
          <h2>{{$movie->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $movie->product_description), 0, 40) ).'...' }}</p>
          <p><a class="btn btn-primary" href="#">Add to cart &raquo;</a>&nbsp;&nbsp;<a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        @endforeach
      </div><!-- /.row -->

      <div class="row">
      <div class="col-lg-4"></div>
	      <div class="col-lg-4">
		      <ul class="pagination">
				  <li><a href="#">&laquo;</a></li>
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">4</a></li>
				  <li><a href="#">5</a></li>
				  <li><a href="#">&raquo;</a></li>
			  </ul>
		  </div>
	  <div class="col-lg-4"></div>
	  </div>
	 

	  <br /><br /><br /><br />
	  
@stop