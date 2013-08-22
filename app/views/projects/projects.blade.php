@extends('layouts.master')

@section('head')
@parent
@stop

@section('content')

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
	<div class="page-header">
  <h1><i class="icon-linux"></i>&nbsp;Welcome!<small>&nbsp;Below are the links to my projects...</small></h1>
 </div>
      <div class="col-lg-2"></div>
	      <div class="col-lg-6">

        <div class="list-group">
            <a href="#" class="list-group-item active">
              My Current Web Projects
            </a>
            <a href="http://rascal.mooo.com:80" class="list-group-item">Laravel 4 project</a>
            <a href="http://rascal.mooo.com:8080" class="list-group-item">CodeIgniter project</a>
            <a href="http://rascal.mooo.com:8000" class="list-group-item">Arcada project</a>
            <a href="https://github.com/sguessou" class="list-group-item"><i class="icon-github"></i>&nbsp;Source Code (Github)</a>
        </div>
            
         </div>
    <div class="col-lg-4"></div>
</div> <!-- Row -->

	

<hr class="featurette-divider">

@stop