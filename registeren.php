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
    require_once("includes/nav.php");
    ?>
    </div>
    <div class="container">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Registeren</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                      <label for="first_name" >Vooraam</label>
                      <input class="form-control" required type="text" name="first_name" id="first_name" value="" placeholder="Naam "><br>
                      <label for="last_name" >Achternaam</label>
                      <input class="form-control" required type="text" name="last_name" id="last_name" value="" placeholder="AchterNaam "><br>
                      <label for="username" >Gebruikersnaam</label>
                      <input class="form-control" required type="text" name="username" id="username" value="" placeholder="Gebruikersnaam "><br>
                      <label for="password" >Wachtwoord</label>
                      <input class="form-control" required type="password" name="password" id="password" value="" placeholder="Wachtwoord"><br>
                      <label for="repeat_password" >Herhaal wachtwoord</label>
                      <input class="form-control" required type="password" name="repeat_password" id="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>
                      <label for="email" >E-mailadres</label>
                      <input class="form-control" required type="email" name="email" id="email" value="" placeholder="E-mailadres"><br>
                      Als u registreert gaat u akkoord met onze <a href="gebruiksvoorwaarden.php">gebruiksvoorwaarden</a>.<br><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Registeren">

                      <div class="gelukt message">Bent nu geregistreerd</div>
                      <div class="error message">Error er iets mis gegaan</div>


                  </form>
                    <?php
                    if (isset($_POST["send"])) {
                        require_once("dbc.php");
                        $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, password, email) VALUES
                                                              (:first_name, :last_name, :username, :password, :email)");

                        $res = $sth->execute([":first_name" => $_POST["first_name"], ":last_name" => $_POST["last_name"], ":username" => $_POST["username"],
                            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT), ":email" => $_POST["email"]]);

                        if ($res) {
                            echo "worked!";
                        } else {
                            echo "username in use";
                        }
                    }
                    ?>
              </div>
          </div>
        </div>
    </div>
    <footer>
        <?php require 'footer.php' ; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/password.js"></script>
</body>

</html>
