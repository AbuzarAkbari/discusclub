<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div id="fb-root"></div>
    <script>
    ;(function(d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0]
  if (d.getElementById(id)) return
  js = d.createElement(s)
  js.id = id
  js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
  fjs.parentNode.insertBefore(js, fjs)
})(document, 'script', 'facebook-jssdk')
</script>

    <div class="header">
      <div class="inlog">
          <a href="inloggen.php">Inloggen</a>
          <a href="registeren.php">Registreer</a>
          <a href="wachtwoordvergeten.php">Wachtwoord vergeten?</a>
      </div>
        <div class="col-xs-6">
            <img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland">
        </div>
    </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>
            </div>
<?php require 'nav_uitloggen.php'; ?>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row sliderbox">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/vissen1.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen2.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen3.jpg" alt="vissen">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container">
      <div class="row columns">
      <div class="col-md-8">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Sponsoren</div>
          <div class="panel-body padding-padding">
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>

          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="panel panel-default">
              <div class="panel-heading border-colors">Advertentie</div>
              <div class="panel-body">
                  <div class="col-md-12 col-sm-12 ruimte"><img src="http://via.placeholder.com/320x320"> </div>
              </div>
          </div>
      </div>
    </div>
  </div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
