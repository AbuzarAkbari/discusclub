<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gebruiker.css">
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
<?php
 // require 'ingelogd.php';
  ?>
  <?php
   require 'uitgelogd.php';
    ?>
      <div class="container">
          <br><br>
        <div class="col-md-12">
            <div class="panel panel-primary border-colors">
                <div class="panel-heading border-color">Gebruiker</div>
                <div class="panel-body text-right">
                    <input type="submit" class="btn btn-primary" name="send" value="Fotoalbums">
                    <input type="submit" class="btn btn-primary" name="send" value="Wijzig profiel">
                    </div>
                </div>
            </div>
        <div class="col-md-4">
            <div class="panel panel-primary border-colors">
                <div class="panel-heading border-color">Informatie</div>
                <div class="panel-body text-left">
                    <div class="text-center"><img src="http://via.placeholder.com/100x100" class="text-center"></div>
                    <div class="col-md-12">
                        <strong>Locatie</strong><br>
                        Onbekend<br>
                        <strong>Leeftijd</strong><br>
                        47<br>
                        <strong>Groep</strong>
                        Leden<br>
                        <strong>rollen</strong> <br>
                        Gebruiker<br>
                        <strong>Geregistreerd</strong><br>
                        woensdag 11 oktober 2017 13:30:39<br>
                        <strong>Forum handtekening</strong><br>
                        ik ben een geile turkse snicker<br>
                </div>
                    </div>
                </div>
            </div>
        <div class="col-md-8">
            <div class="panel panel-primary border-colors">
                <div class="panel-heading border-color">Laatste reacties op topics</div>
                <div class="panel-heading">
                    <table>
                        <tr>
                    <th class="col-md-4 col-xs-4">Topic</th>
                    <th class="col-md-4 col-xs-4">Forum</th>
                    <th class="col-md-4 col-xs-4">Datum</th>
                    <tr>
                </table>
                </div>
                <div class="panel-body text-right">
                    </div>
                </div>
            </div>
        <div class="col-md-8">
            <div class="panel panel-primary border-colors">
                <div class="panel-heading border-color">Albums</div>
                <div class="panel-body text-right">
                    Geen albums gevonden
                    </div>
                </div>
            </div>
            <div class="col-md-12"></div>
        <div class="col-md-4">
            <div class="panel panel-primary border-colors">
                <div class="panel-heading border-color">Statistieken</div>
                <div class="panel-body text-right">
                    <strong>Aantal forum topics
                    </strong><br>
                    0 topics<br>
                    <strong>Aantal forum berichten</strong><br>
                    0 berichten<br>
                    </div>
                </div>
            </div>
        <div class="col-md-8">

            </div>
        </div>

    <div class="conainter-fluid"></div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->
