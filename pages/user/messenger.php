<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");?>
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
                    <img src="http://via.placeholder.com/500x500" class="imgUser imageStatic" />
                    <div class="username"><b>Gebruikersnaam van user</b></div>
                </div>
                <div class="otherTab">
                    <div class="Other">
                        <div><img src="http://via.placeholder.com/350x150" class="otherUsers imageStatic"></div>
                        <div class="UsernameTab"><b>Gebruikersnaam</b></div>
                        <div>tekst die ze zelf invullen</div>
                    </div>
                </div>

                <div class="searchUser">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                      <span class="input-group-btn " id="basic-addon1"><button class="btn btn-secondary buttonHeight" type="button"><i class="glyphicon glyphicon-plus icon "></i></button></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="userTab">
                    <img src="http://via.placeholder.com/500x500" class="imgUser imageStatic" />
                    <div class="username"><b>Gebruikersnaam van user</b></div>
                </div>
                <div class="imageBackgroundText flexcroll">
                    <div class="response ">
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
                    <div class="message ">
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
                    </div>
                <div class="searchUser">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                      <span class="input-group-btn " id="basic-addon1"><button class="btn btn-secondary ButtonHeight" type="button"><i class="glyphicon glyphicon-plus icon "></i></button></span>
                    </div>
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
