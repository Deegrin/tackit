<?php include '../lib/php/header.php'; ?>

<br> <br> <br> <br>

<div id="fb-root"></div>

<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>

<h1> HEY </h1>

<?php include '../lib/php/footer.php'; ?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">


    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tack IT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    
    <div class="jumbotron">
      <div class="container">
        <h1>Welcome to TackIT!</h1>
        <p>Your bookmarks are important to us. We're here to help you rule your bookmarks and to help make browsing the web a more enjoyable experience.</p>
        <p><a class="btn btn-primary btn-lg">Sign Up </a></p>
      </div>
    </div>



<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

  <div class="row">
    <div class="col-md-4 text-center">
      <img src="tack.jpg" class="img-thumbnail">
      <h2>Tack</h2>
      <p>A tack starts with an image or video you add to TackIT. You can add a tack from a website using the upload an image right from your computer. Any Tack on TackIT can be retacked, and all tacks link back to their source.</p>
      <p><a class="btn btn-default" href="#">Start Tacking »</a></p>
    </div>
    <div class="col-md-4 text-center">
      <img src="board.jpg" class="img-thumbnail">
      <h2>Board</h2>
      <p>A board is where you organize your tacks by topic. You could tack ideas for halloween costumes to your October Month board, for example. Boards can be secret or public, and you can invite other people to tack with you on any of your boards.</p>
      <p><a class="btn btn-default" href="#">Start Making Boards »</a></p>
    </div>
    <div class="col-md-4 text-center">
      <img src="follow.jpg" class="img-thumbnail">
      <h2>Follow</h2>
      <p>When you follow someone, their tacks show up in your TackIT dashboard. You can follow all of someone's boards or just the ones you like best.</p>
      <br>
      <br>
      <p><a class="btn btn-default" href="#">Start Following »</a></p>
    </div>
  </div><!-- /.row -->



      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
