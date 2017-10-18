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
<?php
 require 'ingelogd.php';
  ?>
  <?php
  //  require 'ingelogd.php';
    ?>
    <div class="container">
        <div class="row">
            <br>
            <div class="panel panel-primary">
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
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
