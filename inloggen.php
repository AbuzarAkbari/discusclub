<?php
$levels = ["gast", "lid", "gebruiker"];
require("includes/security.php"); ?>
<?php
$error = false;
if (isset($_POST["send"])) {
    require_once("dbc.php");
    $sth = $dbc->prepare("SELECT u.id, u.email, u.first_name, u.last_name, u.username, u.password, r.name as role_name, u.created_at, u.last_changed, u.signature, u.birthdate, u.location, i.path as profile_img, u.profile_img as profile_img_id, news FROM user as u JOIN role as r ON r.id = u.role_id JOIN image as i ON u.profile_img = i.id WHERE u.username = :username");
    $sth->execute([":username" => $_POST["username"]]);
    $res = $sth->fetch(PDO::FETCH_OBJ);

    if (!empty($res)) {
        if (password_verify($_POST["password"], $res->password)) {
            $_SESSION["user"] = $res;
            header("Location: /");
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>
<?php require("includes/security.php"); ?>

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
    <?php require_once("includes/nav.php"); ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Inloggen</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                      <label for="username">Gebruikersnaam</label>
                      <input class="form-control" required type="text" name="username" id="username" value="" placeholder="Naam "><br>
                      <label for="password">Wachtwoord</label>
                      <input class="form-control" required type="password" name="password" id="password" value="" placeholder="Wachtwoord"><br>

                      <input id="onthoud" class="" type="checkbox" name="remember_me" value=""> <label for="onthoud">Onthoud mij</label><br>

                      <a href="wachtwoordvergeten.php">Naam of wachtwoord vergeten?</a><br><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Inloggen">
                  </form>
                    <?php
                    if ($error) {
                        ?>
                        <div class="message error">Verkeerde combinatie, probeer opnieuw.</div>
                        <?php
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
