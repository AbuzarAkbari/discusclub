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
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
                <div class="panel-heading panel-heading1">
                  <h4>Wachtwoord wijzigen van GebruikerId</h4>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET["token"]) && isset($_GET["email"])) {
                        require_once("dbc.php");
                        $sth = $dbc->prepare("SELECT forgot_pass, id FROM user WHERE email = :email");
                        $sth->execute([":email" => $_GET["email"]]);
                        $res = $sth->fetch(PDO::FETCH_OBJ);
                        if (!empty($res) && password_verify($_GET["token"], $res->forgot_pass)) {
                            // set it to null again to prevent someone else doing it again
                            $sth = $dbc->prepare("UPDATE user SET forgot_pass = null WHERE id = :id");
                            $sth->execute([":id" => $res->id]);
                            ?>
                            <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                                Wachtwoord
                                <input class="form-control" required type="password" name="password" value="" placeholder="Wachtwoord"><br>
                                Wachtwoord herhalen
                                <input class="form-control" required type="password" name="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>

                                <input type="submit" class="btn btn-primary" name="send" value="Wijzig">
                            </form>
                            <?php
                        } else {
                            echo "kan het wachtwoord niet wijzigen";
                        }
                    }

                    if (isset($_POST["send"])) {
                        require_once("dbc.php");
                        $sth = $dbc->prepare("UPDATE user SET password = :pass WHERE email = :email");
                        $sth->execute([":pass" => $_POST["password"], ":email" => $_GET["email"]]);
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
</body>

</html>
