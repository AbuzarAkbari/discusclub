<?php require_once("includes/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">
    <link rel="stylesheet" href="css/albums.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <?php require_once("includes/nav.php"); ?>

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Album titel</h3>
                    </div>
                    <div class="panel-body">
                        <div id="images">
                            <img id="image1" src="images\test (1).jpg" />
                            <img id="image2" src="images\test (2).jpg" />
                            <img id="image3" src="images\test (3).jpg" />
                            <img id="image4" src="images\test (4).jpg" />
                        </div>
                        <div id="slider">
                            <a href="#image1" onclick="e => e.preventDefault()">0</a>
                            <a href="#image2" onclick="e => e.preventDefault()">1</a>
                            <a href="#image3" onclick="e => e.preventDefault()">2</a>
                            <a href="#image4" onclick="e => e.preventDefault()">3</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
  <br>
  <br>
  <br>
    <footer>
    <?php require 'footer.php' ; ?>
    </footer>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
