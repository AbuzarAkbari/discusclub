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
    <link rel="stylesheet" href="css/contact.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
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
      <div class="row">
      <div class="col-md-8">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Stel uw vraag</div>
          <div class="panel-body">

              <form action="">
                <label for="fname">Naam</label>
                <input type="text" id="fname" name="firstname" placeholder="Typ hier uw naam">

                <label for="lname">E-mail</label>
                <input type="text" id="lname" name="lastname" placeholder="Typ hier een geldig e-mailadres">

                <label for="subject">Bericht</label>
                <textarea id="subject" name="subject" placeholder="typ hier uw bericht" style="height:200px"></textarea>

                <input type="submit" value="Submit">
              </form>

          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Contactgegevens</div>
          <div class="panel-body">
            Inschrijvingen
            <br>
            <br>
            Discus Club Holland
            <br>
            Hoogstraat 7
            <br>
            3552 XJ Utrecht
            <br>
            <br>
            ING Bank:  4264289
            <br>
            IBAN:         NL51INGB0004264289
            <br>
            BIC:            INGBNL2A
            <br>
            KvK:           30158931
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
    <footer>
        <div class="footer-wrapper">
            <div class="col-md-4 text-center">
                <h3 class="footer-title"><b>Vind ons leuk!</b></h3>
                <div class="fb-page" data-href="https://www.facebook.com/DiscusClubHolland/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/DiscusClubHolland/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <h3 class="footer-title"><b>Volg ons op Twitter!</b></h3>
                <a class="twitter-timeline"  href="https://twitter.com/discusholland?lang=en"  data-widget-id="831416744602431488">Tweets van @HealthBetuwe</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
            <div class="col-md-4 col-sm-12 text-center">
                <h3 class="footer-title"><b>Contact</b></h3>
                <form class="" action="verwerk.php" method="post">
                    <input class="footer-name" type="text" name="naam" value="" placeholder="Naam"><br>
                    <textarea class="footer-message" name="bericht" placeholder="Uw bericht"></textarea><br>
                    <input class="lees-meer-btn footer-btn" type="submit" name="send" value="Verzenden">
                </form>
            </div>
            <div class="col-md-12 text-center">
                <a href="#">&copy; Discus Club Holland</a> | <a href="#">Webdesign door Impact4ROI</a> | <a href="#">Algemene voorwaarden</a>
            </div>
        </div>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
