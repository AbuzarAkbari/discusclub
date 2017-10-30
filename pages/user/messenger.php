<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");

if(isset($_POST["message"]) && isset($_POST["user_id_2"])) {
    $sth = $dbc->prepare("INSERT INTO message(message) VALUES (:message)");
    $sth->execute([":message" => $_POST["message"]]);
    $message_id = $dbc->lastInsertId();

    $sth = $dbc->prepare("INSERT INTO user_has_message(user_id_1, user_id_2, message_id) VALUES (:user_id_1, :user_id_2, :message_id)");
    $sth->execute([":user_id_1" => $_SESSION["user"]->id, ":user_id_2" => $_POST["user_id_2"], ":message_id" => $message_id]);
    $sth->execute([":user_id_1" => $_POST["user_id_2"], ":user_id_2" => $_SESSION["user"]->id, ":message_id" => $message_id]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/message.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
    <br><br><br><br>
    <div class="container main">
        <div class="row">
            <div class="col-md-4">
                <div class="userTab">
                    <img src="/images/profiel/<?php echo $_SESSION["user"]->profile_img; ?>" class="imgUser imageStatic" />
                    <div class="username"><b><?php echo $_SESSION["user"]->username; ?></b></div>
                </div>
                <div class="otherTab flexcroll">
                <?php
                $sth = $dbc->prepare("SELECT *, m.message, m.id, m.created_at, m.last_changed FROM user_has_message as uhm JOIN user as u ON u.id = uhm.user_id_2 JOIN message as m ON uhm.message_id = m.id WHERE uhm.user_id_1 = :id GROUP BY u.id");
                $sth->execute([":id" => $_SESSION["user"]->id]);
                $res = $sth->fetchAll(PDO::FETCH_OBJ);
                $id = isset($_GET["id"]) ? $_GET["id"] : $res[0]->user_id_2;
                foreach ($res as $value) : ?>
                    <?php if ($value->user_id_2 === $id) {
                        $user = $value->first_name . " " . $value->last_name;
                    } ?>
                    <a href="/user/messenger/<?php echo $value->user_id_2; ?>">
                        <div class="other">
                            <div><img src="http://via.placeholder.com/350x150" class="otherUsers imageStatic"></div>
                            <div class="usernameTab"><b><?php echo $value->first_name . " " . $value->last_name; ?></b></div>
                            <div><?php echo implode(" ", array_slice(explode(" ", $value->message), 0, 5)) . "..."; ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
                </div>

                <div class="searchUser">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                      <span class="input-group-btn " id="basic-addon1"><button class="btn btn-secondary buttonHeight" type="button"><i class="glyphicon glyphicon-plus icon "></i></button></span>
                    </div>
                </div>
            </div>
            <?php
            $sth = $dbc->prepare("SELECT * FROM user_has_message as uhm JOIN message as m ON m.id = uhm.message_id JOIN user as u ON uhm.user_id_2 = u.id WHERE uhm.user_id_2 = :id");
            $sth->execute([":id" => $id]);
            $res = $sth->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="col-md-8">
                <div class="userTab">
                    <img src="http://via.placeholder.com/500x500" class="imgUser imageStatic" />
                    <div class="username"><b>bla</b></div>
                </div>
                <div class="imageBackgroundText flexcroll">
                    <?php foreach ($res as $value) : ?>
                        <div class="<?php echo $value->user_id_1 === $_SESSION["user"]->id ? "messages" : "responses" ?>">
                            <div><?php echo $value->message; ?></div>
                        </div>
                    <?php endforeach; ?>
                    <!-- <div class="responses ">
                        <p>
                            tekst Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor.
                            Aenean massa.
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                            Nulla consequat massa quis enim.
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                            Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                            Cras dapibus. Vivamus elementum semper nisi.
                            Aenean vulputate eleifend tellus. Aenean leo ligula,
                            porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                            Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                            Aenean imperdiet. Etiam ultricies nisi vel augue.
                            Curabitur ullamcorper ultricies nisi.
                            Nam eget dui.die ze zelf invullen
                        </p>
                         <div><img src="http://chimpmania.com/forum/attachment.php?attachmentid=33425&d=1369770301&thumb=1" class="messageImage"></div>
                    </div>
                    <div class="messages">
                            <p>
                            tekst Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor.
                             Aenean massa.
                             Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                             Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                             Nulla consequat massa quis enim.
                             Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                             In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                             Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                             Cras dapibus. Vivamus elementum semper nisi.
                             Aenean vulputate eleifend tellus. Aenean leo ligula,
                             porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                             Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                             Aenean imperdiet. Etiam ultricies nisi vel augue.
                             Curabitur ullamcorper ultricies nisi.
                             Nam eget dui.die ze zelf invulldsaen
                         </p>
                    <div><img src="http://chimpmania.com/forum/attachment.php?attachmentid=33425&d=1369770301&thumb=1" class="messageImage"></div>
                </div> -->
                </div>
                <div class="searchUser">
                    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="input-group">
                      <input name="message" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                      <span class="input-group-btn " id="basic-addon1">
                        <button class="btn btn-secondary buttonHeight" type="button">
                            <i class="glyphicon glyphicon-plus icon "></i>
                        </button>
                      </span>
                      <input type="hidden" name="user_id_2" value="<?php echo $id; ?>" />
                    </form>
                </div>
                </div>
            </div>
        </div>
    <br>    <br>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->
