<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");
require_once("../../includes/tools/const.php");
if (isset($_GET["id"]) && in_array($current_level, $admin_levels)) {
    $sth = $dbc->prepare("$USER_SELECT WHERE u.id = :id");
    $sth->execute([":id" => $_GET["id"]]);

    $user_data = $sth->fetch(PDO::FETCH_OBJ);
} else {
    $user_data = $_SESSION["user"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>

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
    require_once("../../includes/components/nav.php");
    ?>
    <div class="container main">
        <div class="row">
            <br>
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/user/">Gebruiker</a></li>
                    <li class="active">Profiel aanpassen</li>
                </ol>
            </div>
            <div class="panel panel-primary ">
                <div class="panel-heading border-color-blue">
                  <h3 class="panel-title">Profiel aanpassen</h3>
                </div>
                <br>
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_GET['error']; ?></div>
                <?php endif; ?>
                <div class="panel-body">
                    <form enctype="multipart/form-data" action="/includes/tools/profielParse" method="post">

                        <?php
                            if ($user_data->news == 1) {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }
                        ?>

                        <input type="hidden" name="news" value="off">
                        <input type="checkbox" name="news" id="news" <?php echo $checked; ?>> <label for="news">Ik wil de DCH news ontvangen </label> <br><br>
                        <label for="email">Email</label><input id="email" class="form-control" type="email" name="email" value="<?php echo isset($user_data->email) ? $user_data->email : ''; ?>" placeholder="Email"><br>
                        <label for="repeat_email">Herhaal email</label><input id="repeat_email" class="form-control" type="email" name="repeat_email" value="<?php echo isset($user_data->email) ? $user_data->email : ''; ?>" placeholder="Herhaal e-mail"><br>
                        <label for="new_password">Nieuw wachtwoord</label><br>
                        <input type="password" name="new_password" class="form-control"><br>
                        <label for="new_password_repeat">Nieuw wachtwoord herhalen</label><br>
                        <input type="password" name="new_password_repeat" class="form-control"><br>

                        <label for="datepicker">Geboortedatum</label>
                        <input class="form-control" id="datepicker" value="" size="30" type="datetime" name="date" placeholder="Geboortedatum"><br>
                        <!-- <label for="datepicker">Geboortedatum</label><input class="form-control" id="datepicker" value="<?php echo isset($user_data->birthdate) ? $user_data->birthdate : ''; ?>" size="30" type="date" name="date" placeholder="Geboortedatum"><br> -->

                        <label for="city">Locatie</label><input id="city" class="form-control" type="text" name="city" value="<?php echo isset($user_data->city) ? $user_data->city : ''; ?>" placeholder="Locatie (max. 35 tekens)" maxlength="35"><br>
                        <label for="file">Profielfoto aanpassen</label><input id="file" class="form-control" accept=".gif,.jpg,.jpeg,.png" type="file" name="profiel" placeholder="Selecteer bestand"><br>
                        <label for="berichten">Berichten achtergrond aanpassen</label><input id="berichten" class="form-control" accept=".gif,.jpg,.jpeg,.png" type="file" name="background" placeholder="Selecteer bestand"><br>
                        <label for="signature">Handtekening</label><input id="signature" class="form-control" type="text" name="signature" value="<?php echo isset($user_data->signature) ? $user_data->signature : ''; ?>" placeholder="Handtekening (max. 35 tekens)" maxlength="35"><br>
                        <label for="wachtwoord">Wachtwoord</label><input required id="wachtwoord" class="form-control" type="password" name="wachtwoord" value="" placeholder="Wachtwoord ter bevestiging"><br>
                        <input type="hidden" value="<?php echo $user_data->id; ?>" name="user_id">
                        <input type="hidden" value="<?php echo $user_data->profile_img_id; ?>" name="profile_img_id">
                        <input type="hidden" value="<?php echo $user_data->profile_img_id; ?>" name="profile_img_id">
                        <input type="submit" class="btn btn-primary" name="profiel_parse" value="Opslaan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
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
    <script src="/js/drag-drop.js" charset="utf-8"></script>
</body>
</html>
