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

  <body>


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