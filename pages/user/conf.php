<?php
require_once("../../includes/tools/security.php");

if (isset($_GET["id"])) {
    $sth = $dbc->prepare("SELECT u.id, u.email, u.first_name, u.last_name, u.username, u.password, r.name as role_name, u.created_at, u.last_changed, u.signature, u.birthdate, u.location, i.path as profile_img, u.profile_img as profile_img_ida, news FROM user as u JOIN role as r ON r.id = u.role_id JOIN image as i ON u.profile_img = i.id WHERE u.id = :id");
    $sth->execute([":id" => $_GET["id"]]);

    $user_data = $sth->fetch(PDO::FETCH_OBJ);
} else {
    $user_data = $_SESSION["user"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" href="/css/album-upload.css">

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
            <div class="panel panel-primary ">
              <div class="panel-heading border-color-blue">
                <h3 class="panel-title">Profiel aanpassen</h3>
              </div>
              <div class="panel-body">
                    <form enctype="multipart/form-data" action="/includes/tools/profielParse" method="post">

                        <?php


                        if ($user_data->news == 1) {
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                        ?>

                        <input type="hidden" name="nieuwsbrief" value="off">
                        <input type="checkbox" name="nieuwsbrief" id="nieuwsbrief" <?php echo $checked; ?>> <label for="nieuwsbrief">Ik wil de DCH nieuwsbrief ontvangen </label> <br><br>
                        <label for="email">Email</label><input id="email" class="form-control" type="email" name="email" value="<?php echo isset($user_data->email) ? $user_data->email : ''; ?>" placeholder="Email"><br>
                        <label for="repeat_email">Herhaal email</label><input id="repeat_email" class="form-control" type="email" name="repeat_email" value="<?php echo isset($user_data->email) ? $user_data->email : ''; ?>" placeholder="Herhaal e-mail"><br>
                        <label for="datepicker">Geboortedatum</label><input class="form-control" id="datepicker" value="<?php echo isset($user_data->birthdate) ? $user_data->birthdate : ''; ?>" size="30" type="datetime" name="date" placeholder="Geboortedatum"><br>
                        <label for="location">Locatie</label><input id="location" class="form-control" type="text" name="location" value="<?php echo isset($user_data->location) ? $user_data->location : ''; ?>" placeholder="Locatie"><br>
                        <label for="profiel">Selecteer een afbeelding</label><input id="file" class="form-control" accept=".gif,.jpg,.jpeg,.png" type="file" name="profiel" placeholder="Selecteer bestand"><br>
                        <label for="signature">Handtekening</label><input id="signature" class="form-control" type="text" name="signature" value="<?php echo isset($user_data->signature) ? $user_data->signature : ''; ?>" placeholder="Handtekening"><br>
                        <label for="password">Wachtwoord</label><input id="wachtwoord" class="form-control" type="password" name="wachtwoord" value="" placeholder="Wachtwoord ter bevestiging"><br>
                        <input type="hidden" value="<?php echo $user_data->id; ?>" name="user_id">
                        <input type="hidden" value="<?php echo $user_data->profile_img_id; ?>" name="profile_img_id">
                        <input type="submit" class="btn btn-primary" name="profiel_parse" value="Opslaan">
                    </form>
                    <div class="container1 main">
                        <div class="row">
                            <form method="post" action="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" enctype="multipart/form-data" novalidate="" class="box has-advanced-upload">
                                <div class="box__input">
                                    <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
                                    <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple="">
                                    <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                                    <button type="submit" class="box__button">Upload</button>
                                </div>
                                <div class="box__uploading">Uploading…</div>
                                <div class="box__success">Done! <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box__restart" role="button">Upload more?</a></div>
                                <div class="box__error">Error! <span></span>. <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?submit-on-demand" class="box__restart" role="button">Try again!</a></div>
                                   <input type="hidden" name="ajax" value="1">
                            </form>
                        </div>
                    </div>

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
            yearRange: "-100:+0",
            defaultDate: '01/01/1980'
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
