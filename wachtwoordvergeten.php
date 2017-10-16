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
    <div class="container-fluid headerzijkant">

    </div>
        <div class="header container">
    <?php require "ingelogd.php" ?>
            <div class="col-xs-6">
                <a href="/"><img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland"></a>
            </div>
        </div>
        <div class="container-fluid headerzijkant">

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
    </div>
    <div class="container">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Inloggen</h4></div>
                <div class="panel-body">
                  <form class="" action="index.php" method="post">

                  <p>U zal een e-mail met uw naam ontvangen. Wij zullen nooit uw wachtwoord toezenden, want die weten wij ook niet (ter beveiliging). De e-mail bevat in plaats daarvan een link waarmee u uw wachtwoord kan wijzigen.</p>

                      E-mailadres
                      <input class="form-control" required type="text" name="" value="" placeholder="E-mail"><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Stuur mij de e-mail">
                      <br>
                      <br>
                      <p>Houd in gedachten dat deze functionaliteit altijd zegt dat u uw e-mail moet nakijken. Het geeft geen enkele indicatie of het e-mail adres goed of fout is.</p>

                  </form>

              </div>
          </div>
        </div>
    </div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
