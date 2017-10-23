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
    <?php
     require 'ingelogd.php';
      ?>
      <?php
      //  require 'ingelogd.php';
        ?>

    <br><br>
    <div class="container">
      <div class="row">
      <div class="col-md-8">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Stel uw vraag</div>
          <div class="panel-body">
              <form action="">
                <label for="fname">Naam</label>
                <input type="text" class="form-control" name="firstname" placeholder="Uw naam">
                <br>
                <label for="lname">E-mail</label>
                <input type="text" class="form-control" name="lastname" placeholder="Uw email">
                <br>
                <label for="subject">Bericht</label>
                <textarea id="subject" class="form-control" placeholder="Uw bericht" style="height:200px"></textarea>
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
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
  <?php require 'footer.php' ; ?>
  </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
