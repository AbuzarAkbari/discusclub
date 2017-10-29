<?php require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
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
    require_once("../../includes/components/nav.php");
    ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Wachtwoord vergeten</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                      <p>U zal een e-mail met uw naam ontvangen. Wij zullen nooit uw wachtwoord toezenden, want die weten wij ook niet (ter beveiliging). De e-mail bevat in plaats daarvan een link waarmee u uw wachtwoord kan wijzigen.</p>

                      <label for="email">E-mailadres</label>
                      <input class="form-control" required type="text" name="email" id="email" value="" placeholder="E-mail"><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Stuur mij de e-mail">
                      <br>
                      <br>
                      <p>Houd in gedachten dat deze functionaliteit altijd zegt dat u uw e-mail moet nakijken. Het geeft geen enkele indicatie of het e-mail adres goed of fout is.</p>

                  </form>

                    <?php
                    if (isset($_POST["send"])) {
                        $token = md5(microtime (true)*100000);
                        $message =  "/user/wachtwoordwijzigen?token=$token&email=$_POST[email]";
                        $sth = $dbc->prepare("UPDATE user set forgot_pass = :hash WHERE email = :email");

                        try {
                            $res = $sth->execute([":hash" => password_hash($token, PASSWORD_BCRYPT), ":email" => $_POST["email"]]);
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }

                        if ($res) {
                            echo "updated db";
                        }

                        echo $message;
                    }

                    ?>

              </div>
          </div>
        </div>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
