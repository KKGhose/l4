@extends('layouts.master')



@section('content')



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <h1><i class="icon-film"></i>&nbsp;New From DVD Movies:</h1><br />
        @foreach ($movies as $movie)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{$base_url}}/images/products_images/{{$movie->id.'_thumb.jpg'}}" style="width:160;height:220;">
          <h2>{{$movie->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $movie->product_description), 0, 40) ).'...' }}</p>
          <p><a class="btn btn-primary" href="#">Add to cart &raquo;</a>&nbsp;&nbsp;<a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        @endforeach
      </div><!-- /.row -->

      <hr class="featurette-divider">

      <div class="row">
       <h1><i class="icon-book"></i>&nbsp;New From IT-Ebooks:</h1><br />
        @foreach ($ebooks as $ebook)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{$base_url}}/images/products_images/{{$ebook->id.'_thumb.jpg'}}" style="width:160;height:220;">
          <h2>{{$ebook->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $ebook->product_description), 0, 40) ).'...' }}</p>
          <p><a class="btn btn-primary" href="#">Add to cart &raquo;</a>&nbsp;&nbsp;<a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        @endforeach
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" data-src="{{$base_url}}/holder.js/512x512">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-left" data-src="{{$base_url}}/holder.js/512x512">
        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" data-src="{{$base_url}}/holder.js/512x512">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      

    @stop