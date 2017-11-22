<?php require_once("../../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../../includes/components/head.php"); ?>
</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
    require_once("../../../includes/components/nav.php");
    ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
                <div class="panel-heading panel-heading1">
                  <h4>Wachtwoord wijzigen</h4>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET["token"]) && isset($_GET["id"])) {
                        $sth = $dbc->prepare("SELECT * FROM forgot WHERE id = :id AND DATE_SUB(NOW(), INTERVAL 1 HOUR) < created_at");
                        $sth->execute([":id" => $_GET["id"]]);
                        $res = $sth->fetch(PDO::FETCH_OBJ);

                        if (!empty($res) && password_verify($_GET["token"], $res->token)) {
                            if (isset($_POST["send"])) {
                                $sth = $dbc->prepare("UPDATE user SET password = :pass WHERE id = :id");
                                $sth->execute([":pass" => password_hash($_POST["password"], PASSWORD_BCRYPT), ":id" => $res->user_id]);
                                $sth = $dbc->prepare("DELETE FROM forgot WHERE id = :id");
                                $sth->execute([":id" => $_GET["id"]]);
                                ?>
                                <div class="message gelukt">Wachtwoord is gewijzigd, <a href="/user/login">login.</a></div>
                                <?php
                            } else {
                                ?>
                                <form class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                                    Wachtwoord
                                    <input class="form-control" required type="password" name="password" value="" placeholder="Wachtwoord"><br>
                                    Wachtwoord herhalen
                                    <input class="form-control" required type="password" name="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>

                                    <input type="submit" class="btn btn-primary" name="send" value="Wijzig">
                                </form>
                                <?php
                            }
                            ?>
                            <?php
                        } else {
                            $sth = $dbc->prepare("DELETE FROM forgot WHERE id = :id");
                            $sth->execute([":id" => $_GET["id"]]);
                            ?>
                            <div>Kan het wachtwoord niet wijzigen, <a href="/user/password/forgot">vraag nieuwe link aan</a>.</div>
                            <?php
                        }
                    }
                    ?>
              </div>
          </div>
        </div>
    </div>
    <footer>
<?php require_once("../../../includes/components/footer.php") ; ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
