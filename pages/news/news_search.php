<?php require_once("../../includes/tools/security.php");



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
    <link rel="stylesheet" href="/css/nieuws.css">
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
    <?php
    require_once("../../includes/components/nav.php");
    ?>

    <br><br>
    <div class="container main">
        <div class="row columns">
        <div class="col-md-12">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/news/">Nieuws</a></li>
                    <li class="active">Zoek nieuws</li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                <div class="panel-heading border-colors">
                    <h3 class="panel-title">Zoek nieuws</h3>
                </div>
                    <div class="panel-body">
                        <form method="post" action="/includes/tools/album-upload" enctype="multipart/form-data">
                            <input type="text" class="form-control" name="album_name" placeholder='Zoek hier naar nieuwsartikelen' maxlength="155" required ><br>
                            <button type="submit" name="search_news" class="form-control btn btn-primary">Zoek artikel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php if ($logged_in && in_array($current_level, ["redacteur", "admin"])) :?>
    <footer>
        <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>