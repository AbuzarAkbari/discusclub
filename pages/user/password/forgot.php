<?php require_once("../../../includes/tools/security.php"); ?>
<?php
$success = false;
if (isset($_POST["send"])) {
    $sth = $dbc->prepare("SELECT id, email,username,first_name,last_name FROM user WHERE email = :email");
    $sth->execute([":email" => $_POST["email"]]);
    $res = $sth->fetch(PDO::FETCH_OBJ);
    if($res) {
        $token = md5(microtime (true)*100000);
        $sth = $dbc->prepare("INSERT INTO forgot(token, user_id, created_at) VALUES (:token, :user_id, NOW())");
        $sth->execute([":token" => password_hash($token, PASSWORD_BCRYPT), ":user_id" => $res->id]);
        // TODO:: add mailing thingy, add this link and username
        $url = $_SERVER["HTTP_HOST"] ."/user/password/change?token=$token&id=".$dbc->lastInsertId();
        $username = $res->username;
        $first_name = $res->first_name;
        $last_name = $res->last_name;
        ob_start();
        require_once("wachtwoord-vergeten.php");
        $message = ob_get_clean();
        $headers =  'From: redactie@discusclubholland.nl' . "\r\n" .
            'Content-Type: text/html; charset=utf-8'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($res->email, "Wachtwoord vergeten", wordwrap($message, 70, "\r\n"), $headers);
    }
    $success = true;
}
?>
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
                <h4>Wachtwoord vergeten</h4></div>
            <div class="panel-body">
                <?php if(isset($_GET['err'])  && !$success) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_GET['err']; ?></div>
                <?php else: ?>
                    <div class='message gelukt'>Mail is verstuurd </div>
                <?php endif; ?>
                <form class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">

                    <p>U zal een e-mail met uw naam ontvangen. Wij zullen nooit uw wachtwoord toezenden, want die weten wij ook niet (ter beveiliging). De e-mail bevat in plaats daarvan een link waarmee u uw wachtwoord kan wijzigen.</p>

                    <label for="email">E-mailadres</label>
                    <input class="form-control" required type="text" name="email" id="email" value="" placeholder="E-mail"><br>

                    <input type="submit" class="btn btn-primary" name="send" value="Stuur mij de e-mail">
                    <br>
                    <br>
                    <p>Houd in gedachten dat deze functionaliteit altijd zegt dat u uw e-mail moet nakijken. Het geeft geen enkele indicatie of het e-mail adres goed of fout is.</p>

                </form>



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
