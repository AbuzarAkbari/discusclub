<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");

if(isset($_POST["message"]) && isset($_POST["user_id_2"])) {
    $sth = $dbc->prepare("INSERT INTO message(message, user_id_1, user_id_2) VALUES (:message, :user_id_1, :user_id_2)");
    $sth->execute([":user_id_1" => $_SESSION["user"]->id, ":user_id_2" => $_POST["user_id_2"], ":message" => $_POST["message"]]);
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
            <div class="col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="/user/">Gebruiker</a></li>
                        <li class="active">Chat</li>
                    </ol>
                </div></div>
            <div class="col-md-4">
                <div class="userTab">
                    <img src="/images/profiel/<?php echo $_SESSION["user"]->profile_img; ?>" class="imgUser imageStatic" />
                    <div class="username"><b> <?php echo $_SESSION["user"]->first_name . " " . $_SESSION["user"]->last_name; ?></b></div>
                </div>
                <div id="userTable" class="otherTab flexcroll">
                    <?php
                    $sth = $dbc->prepare("SELECT DISTINCT *, m.message, m.id, m.created_at FROM message as m JOIN user as u ON u.id = m.user_id_2 WHERE m.user_id_1 = :id OR m.user_id_2 = :id GROUP BY u.id ORDER BY m.created_at ASC");
                    $sth->execute([":id" => $_SESSION["user"]->id]);
                    $res = $sth->fetchAll(PDO::FETCH_OBJ);
                    $id = isset($_GET["id"]) ? $_GET["id"] : $res[0]->user_id_2;
                    foreach ($res as $value) : ?>
                        <?php

                        $sth = $dbc->prepare("SELECT m.message FROM message as m WHERE user_id_1 = :id OR user_id_2 = :id ORDER BY m.created_at DESC LIMIT 1");
                        $sth->execute([":id" => $id]);
                        $last_message = $sth->fetch(PDO::FETCH_OBJ)->message;

                        if ($value->user_id_2 === $id) {
                            $user = $value->first_name . " " . $value->last_name;
                        } ?>
                        <?php if($value->user_id_1 === $_SESSION["user"]->id) :?>
                            <a href="/user/messenger/<?php echo $value->user_id_2; ?>">
                                <div class="other">
                                    <div><img src="http://via.placeholder.com/350x150" class="otherUsers imageStatic"></div>
                                    <div class="usernameTab"><b><?php echo $value->first_name . " " . $value->last_name; ?></b></div>
                                    <div><?php echo substr($last_message, 0, 25) . "..."; ?></div>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="searchUser">
                    <div class="form-group">
                      <input type="text" class="form-control" name="userSearch" placeholder="" aria-describedby="basic-addon1">
                      <!-- <span class="input-group-btn " id="basic-addon1"><button class="btn btn-secondary buttonHeight" type="button"><i class="glyphicon glyphicon-plus icon "></i></button></span> -->
                    </div>
                </div>
            </div>
            <?php
            $sth = $dbc->prepare("SELECT * FROM message as m JOIN user as u ON m.user_id_2 = u.id WHERE m.user_id_2 = :id");
            $sth->execute([":id" => $id]);
            $res = $sth->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="col-md-8">
                <div class="userTab">
                    <img src="http://via.placeholder.com/500x500" class="imgUser imageStatic" />
                    <div class="username"><b> <?php echo $res[0]->first_name . " " . $res[0]->last_name ?></b></div>
                </div>
                <div id="message" style="background-image: url('/images/messenger_background/default.jpg');" class="imageBackgroundText flexcroll tab">
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
                    <form id="search" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="input-group">
                      <input name="message" type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                      <span class="input-group-btn " id="basic-addon1">
                        <button class="btn btn-secondary buttonHeight" type="button">
                            <i class="glyphicon glyphicon-plus icon "></i>
                        </button>
                      </span>

                      <!-- <div class="input-group">
                        <input type="text" class="form-control" name="userSearch" placeholder="" aria-describedby="basic-addon1">
                        <span class="input-group-btn  " id="basic-addon1"><button class="btn btn-secondary buttonHeight" type="button"><i class="glyphicon glyphicon-plus icon "></i></button></span>
                      </div> -->

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
    <script>
        const id = <?php echo $id ?>;
        const user_id = <?php echo $_SESSION["user"]->id; ?>;
    </script>
    <script src="/js/messenger.js"></script>
    <script type="text/javascript">
    $(".tab").animate({ scrollTop: $(document).height() });
    </script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->
