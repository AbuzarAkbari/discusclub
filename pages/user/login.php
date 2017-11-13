<?php
$levels = ["gast", "lid", "gebruiker"];
require("../../includes/tools/security.php"); ?>
<?php
$error = false;
if (isset($_POST["send"])) {
    require_once("../../includes/tools/const.php");
    $sth = $dbc->prepare($USER_SELECT . " WHERE u.username = :username");
    $sth->execute([":username" => $_POST["username"]]);
    $res = $sth->fetch(PDO::FETCH_OBJ);

    if (!empty($res)) {
        if(empty($res->password)) {
            header("Location: /user/password/forgot.php?err=Vanwege de nieuwe website moet u een nieuw wachtwoord maken");
            exit();
        }
        if (password_verify($_POST["password"], $res->password)) {
            $_SESSION["user"] = $res;
            if (isset($_GET["redirect"])) {
                header("Location: " . $_GET["redirect"]);
            } else {
                header("Location: /");
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>
<?php //require("../../includes/tools/security.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
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
    <?php require_once("../../includes/components/nav.php"); ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
            <?php
            if (isset($_GET["redirect"])) {
                ?>
                <div class="message warning">Login om verder te gaan.</div>
                <?php
            }
            ?>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Inloggen</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                      <label for="username">Gebruikersnaam</label>
                      <input class="form-control" required type="text" name="username" id="username" value="" placeholder="Naam "><br>
                      <label for="password">Wachtwoord</label>
                      <input class="form-control" required type="password" name="password" id="password" value="" placeholder="Wachtwoord"><br>

                      <!-- <input id="onthoud" class="" type="checkbox" name="remember_me" value=""> <label for="onthoud">Onthoud mij</label><br> -->

                      <a href="/user/password/forgot">Naam of wachtwoord vergeten?</a><br><br>

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
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
