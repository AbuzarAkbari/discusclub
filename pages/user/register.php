<?php require_once("../../includes/tools/security.php"); ?>
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
    <?php
    require_once("../../includes/components/nav.php");
    ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Registreren</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                      <label for="first_name" >Voornaam</label>
                      <input class="form-control" required type="text" name="first_name" id="first_name" value="" placeholder="Voornaam "><br>
                      <label for="last_name" >Achternaam</label>
                      <input class="form-control" required type="text" name="last_name" id="last_name" value="" placeholder="Achternaam "><br>
                      <label for="username" >Gebruikersnaam</label>
                      <input class="form-control" required type="text" name="username" id="username" value="" placeholder="Gebruikersnaam "><br>
                      <label for="datepicker">Geboortedatum</label><input class="form-control" id="datepicker" value="" size="30" type="datetime" name="date" placeholder="Geboortedatum"><br>
                      <label for="password" >Wachtwoord</label>
                      <input class="form-control" required type="password" name="password" id="password" value="" placeholder="Wachtwoord"><br>
                      <label for="repeat_password" >Herhaal wachtwoord</label>
                      <input class="form-control" required type="password" name="repeat_password" id="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>
                      <label for="email" >E-mailadres</label>
                      <input class="form-control" required type="email" name="email" id="email" value="" placeholder="E-mailadres"><br>
                      Als u registreert gaat u akkoord met onze <a href="/gebruiksvoorwaarden">gebruiksvoorwaarden</a>.<br><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Registeren">

                  </form>
                    <?php
                    if (isset($_POST["send"])) {
                        $sth = $dbc->prepare("SELECT email, username FROM user WHERE email = :email OR username = :username");

                        $sth->execute([":email" => $_POST["email"], ":username" => $_POST["username"]]);

                        $res = $sth->fetch(PDO::FETCH_OBJ);

                        if (empty($res)) {
                            $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, password, email, created_at) VALUES
                                                                  (:first_name, :last_name, :username, :password, :email, NOW())");

                            $sth->execute([":first_name" => $_POST["first_name"], ":last_name" => $_POST["last_name"], ":username" => $_POST["username"],
                                ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT), ":email" => $_POST["email"]]);
                            ?>
                            <div class="message gelukt">Het account is aangemaakt, <a href="/user/login">login.</a></div>
                            <?php
                        } else {
                            if ($res->email === $_POST["email"]) {
                                ?>
                                <div class="message error">Email is al in gebruik. <a href="/user/password/forgot">Wijzig wachtwoord.</a></div>
                                <?php
                            } else {
                                ?>
                                <div class="message error">Gebruikersnaam is al in gebruik, kies een andere gebruikersnaam.</div>
                                <?php
                            }
                        }
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-90:+0",
            defaultDate: '01/01/1980',
            dateFormat: 'dd-mm-yy'
        });
    } );
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#anim" ).on( "change", function() {
            $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
        });
    } );
    </script>
    <script src="/js/password.js"></script>
</body>

</html>
