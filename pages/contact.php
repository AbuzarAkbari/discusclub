<?php require_once("../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">
    <link rel="stylesheet" href="/css/contact.css">
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
    <?php
    require_once("../includes/components/nav.php");
    ?>

    <br><br>
    <div class="container main">
      <div class="row">
    <div class="col-md-12">
      <div class="">
      <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Contact</li>
      </ol>
      </div>
    </div>
      <div class="col-md-8">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Stel uw vraag</div>
          <div class="panel-body">
              <form action="/includes/tools/verwerk" method="post">
                <label for="fname">Naam</label>
                <input id="fname" type="text" class="form-control" name="naam" placeholder="Uw naam">
                <br>
                <label for="email">E-mail</label>
                <input id="email" type="text" class="form-control" name="email" placeholder="Uw e-mail">
                <br>
                <label for="subject">Bericht</label>
                <textarea id="subject" name="bericht" class="form-control" placeholder="Uw bericht" style="height:200px; resize: none;"></textarea>
                <br>
                <input type="submit" class="btn btn-primary" value="Verstuur">
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
    <?php require_once("../includes/components/footer.php") ; ?>
  </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
