<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
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
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Profiel aanpassen</h3>
              </div>
              <div class="panel-body">
                    <form class="" action="geenidee.php" method="post">
                        <input type="checkbox" name="" value=""> Ik wil de DCH nieuwsbrief ontvangen <br><br>
                        <input class="form-control" type="password" name="" value="" placeholder="Wachtwoord"><br>
                        <input class="form-control" type="password" name="" value="" placeholder="Herhaal wachtwoord"><br>
                        <input class="form-control" type="email" name="" value="" placeholder="E-mail"><br>
                        <input class="form-control" type="email" name="" value="" placeholder="Herhaal e-mail"><br>
                        <input class="form-control" type="date" name="date1" min="1950-01-01" max=<?php echo date('Y-m-d');?> placeholder="Geboortedatum"><br>
                        <input class="form-control" type="text" name="" value="" placeholder="Locatie"><br>
                        <input class="form-control" accept=".gif,.jpg,.jpeg,.png" type="file" name="" value="" placeholder="Selecteer bestand"><br>
                        <input class="form-control" type="text" name="" value="" placeholder="Handtekening"><br>
                        <input type="submit" class="btn btn-primary" name="" value="Opslaan">
                    </form>
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
