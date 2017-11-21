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

            <?php
            $error = false;
          if (isset($_POST["send"])) {
              $date = strtotime($_POST["birthdate"]);
              if ($date === false) {
                  echo "<div class='message error'>Geboortedatum is geen datum of verkeerd opgegeven.</div>";
              }
              else{
              $sth = $dbc->prepare("SELECT email, username FROM user WHERE email = :email OR username = :username");

              $sth->execute([":email" => $_POST["email"], ":username" => $_POST["username"]]);

              $res = $sth->fetch(PDO::FETCH_OBJ);

              if (empty($res)) {
                  $sth = $dbc->prepare("INSERT INTO user(first_name, last_name, username, password, email, created_at,birthdate, news) VALUES
                  (:first_name, :last_name, :username, :password, :email, NOW(),:birthdate, :news )");

                  $sth->execute([
                      ":first_name" => $_POST["first_name"],
                      ":last_name" => $_POST["last_name"],
                      ":username" => $_POST["username"],
                      ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT),
                      ":email" => $_POST["email"],
                      ":birthdate" => date('d-m-y', strtotime($_POST["birthdate"])),
                      ":news" => isset($_POST["news"]) && $_POST["news"] === "on" ? 1 : 0]);
                      require("../../includes/tools/mailer.php");
                      ?>
                      <div class="message gelukt">Het account is aangemaakt, <a href="/user/login">login.</a></div>
                      <?php
                  } else {
                      $error = true;
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
              }

            ?>
            <?php
                $firstName = $lastName = $userName = $email =  "";
                if (isset($_POST["send"]) && $error) {
                    $firstName = input($_POST["first_name"]);
                    $lastName = input($_POST["last_name"]);
                    $userName = input($_POST["username"]);
                    $email = input($_POST["email"]);
                };
                function input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    return $data;
                }
              // if (isset($_POST['send'])) {
              //     $_SESSION['first_name'] = $_POST['first_name'];
              //     $_SESSION['last_name'] = $_POST['last_name'];
              //     $_SESSION['username'] = $_POST['username'];
              //     $_SESSION['email'] = $_POST['email'];
              // }
              //
              // $_SESSION['post'] = $_POST;
              //

              ?>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Registreren</h4></div>
                <div class="panel-body">
                  <form class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" autocomplete="false" >
                      <label for="first_name" >Voornaam</label>
                      <input class="form-control" required type="text" name="first_name" id="first_name" value="<?php echo $firstName; ?>" placeholder="Voornaam "><br>
                      <label for="last_name" >Achternaam</label>
                      <input class="form-control" required type="text" name="last_name" id="last_name" value="<?php echo $lastName; ?>" placeholder="Achternaam "><br>
                      <label for="username" >Gebruikersnaam</label>
                      <input class="form-control" required type="text" name="username" id="username" value="<?php echo $userName; ?>" placeholder="Gebruikersnaam "><br>
                      <label for="datepicker">Geboortedatum</label>
                      <input autocomplete="off" class="form-control" id="datepicker" value="" size="30" type="datetime" name="birthdate" placeholder="Geboortedatum" autocomplete="off"><br>
                      <label for="password" >Wachtwoord</label>
                      <input class="form-control" required type="password" name="password" id="password" value="" placeholder="Wachtwoord"><br>
                      <label for="repeat_password" >Herhaal wachtwoord</label>
                      <input class="form-control" required type="password" name="repeat_password" id="repeat_password" value="" placeholder="Herhaal wachtwoord"><br>
                      <label for="email" >E-mailadres</label>
                      <input class="form-control" required type="email" name="email" id="email" value="<?php echo $email;?>" placeholder="E-mailadres"><br>
                      <input type="checkbox" name="news" id="news"><label for="news"> Ik wil de DCH nieuwsbrief ontvangen </label> <br><br>
                      Als u registreert gaat u akkoord met onze <a href="/gebruiksvoorwaarden">gebruiksvoorwaarden</a>.<br><br>

                      <input type="submit" class="btn btn-primary" name="send" value="Registeren">
                  </form>

              </div>
          </div>
        </div>
    </div>
    <footer>
        <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <?php require_once("../../includes/components/datepicker.php"); ?>
    <script src="/js/password.js"></script>
</body>

</html>
