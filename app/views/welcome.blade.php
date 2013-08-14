@extends('layouts.master')

@section('head')
@parent
  {{ HTML::style('css/modal_img.css') }}
@stop


@section('content')



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <h1><i class="icon-film"></i>&nbsp;New From DVD Movies:</h1><br />
        @foreach ($movies as $movie)
        <div class="col-lg-4">
          <img class="img-rounded" src="{{$base_url}}/images/products_images/{{$movie->id.'_thumb.jpg'}}">
          <h2>{{$movie->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $movie->product_description), 0, 20) ).'...' }}</p>
          <p><a class="btn btn-primary" href="#">Add to cart &raquo;</a>&nbsp;&nbsp;
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
              <img src="{{$base_url}}/images/products_images/{{$movie->id}}_thumb.jpg">
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
          <img class="img-rounded" src="{{$base_url}}/images/products_images/{{$ebook->id.'_thumb.jpg'}}">
          <h2>{{$ebook->product_name}}</h2>
          <p>{{ implode(' ', array_slice( explode(' ', $ebook->product_description), 0, 20) ).'...' }}</p>
          <p><a class="btn btn-primary" href="#">Add to cart &raquo;</a>&nbsp;&nbsp;
          <a data-toggle="modal" href="#myModal_{{$ebook->id}}" class="btn btn-default">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->


          {{-- Start Modal --}}
          <!-- Modal -->
          <div class="modal fade" id="myModal_{{$ebook->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h3 class="modal-title"><i class="icon-film"></i>&nbsp;{{$ebook->product_name}}</h3>
                </div>
                <div class="modal-body">
                 <h4>Ebook Description</h4><br />
                <div class="twist_img">
              <img src="{{$base_url}}/images/products_images/{{$ebook->id}}_thumb.jpg">
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