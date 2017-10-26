<?php require_once("includes/security.php"); ?>
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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">



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
    require_once("includes/nav.php");
    ?>
    <div class="container main">
        <div class="row">
            <br>
            <div class="panel panel-primary ">
              <div class="panel-heading border-color-blue">
                <h3 class="panel-title">Profiel aanpassen</h3>
              </div>
              <div class="panel-body">
                    <form enctype="multipart/form-data" action="profielParse.php" method="post">
                        <input type="checkbox" name="" value="" id="nieuwsbrief"> <label for="nieuwsbrief">Ik wil de DCH nieuwsbrief ontvangen </label> <br><br>
                        <label for="password">Wachtwoord</label><input id="password" class="form-control" type="password" name="password" placeholder="Wachtwoord"><br>
                        <label for="repeat_password">Herhaal wachtwoord</label><input id="repeat_password" class="form-control" type="password" name="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>
                        <label for="email">Email</label><input id="email" class="form-control" type="email" name="email" value="" placeholder="Email"><br>
                        <label for="repeat_email">Herhaal email</label><input id="repeat_email" class="form-control" type="email" name="repeat_email" value="" placeholder="Herhaal e-mail"><br>
                        <label for="datepicker">Geboortedatum</label><input class="form-control" id="datepicker" size="30" type="datetime" name="date" placeholder="Geboortedatum"><br>
                        <label for="location">Locatie</label><input id="location" class="form-control" type="text" name="location" value="" placeholder="Locatie"><br>
                        <label for="profiel">Selecteer een afbeelding</label><input id="file" class="form-control" accept=".gif,.jpg,.jpeg,.png" type="file" name="profiel" value="" placeholder="Selecteer bestand"><br>
                        <label for="signature">Handtekening</label><input id="signature" class="form-control" type="text" name="signature" value="" placeholder="Handtekening"><br>
                        <input type="submit" class="btn btn-primary" name="profiel_parse" value="Opslaan">
                    </form>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $( function() {
        $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-100:+0",
          defaultDate: '01/01/1980'
        });
      } );
      $( function() {
        $( "#datepicker" ).datepicker();
        $( "#anim" ).on( "change", function() {
          $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
        });
      } );
  </script>
</body>
</html>
