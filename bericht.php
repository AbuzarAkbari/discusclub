<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bericht.css">
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
     require 'ingelogd.php';
      ?>
      <?php
      //  require 'ingelogd.php';
        ?>
<br>
    <br>
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Item</h3>
                </div>
                <div class="panel-heading text-right">
                    <input type="submit" class="btn btn-primary" name="send" value="Favoriete">
                    <input type="submit" class="btn btn-primary" name="send" value="Button 1">
                    <input type="submit" class="btn btn-primary" name="send" value="Button 2">
                </div>
                <div class="panel-body">
                    <div class="wrapper-box col-md-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="">
                        </div>
                        <div class="col-md-10">
                            <p>
                            <h4>Titel</h4></p>
                            You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                            but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't
                            hold a candle to man.
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    #102439	<b>Geplaatst door:</b> <i>Jack Sparrow</i> op donderdag 23 februari 2017 17:22:28</h3>
                </div>
            </div>
            <div class="panel panel-primary">

                <div class="panel-body">
                    <div class="wrapper-box col-md-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="x">
                        </div>
                        <div class="col-md-10">
                            <p>
                            <h4><b>Antwoord op:</b><i> Lorem ipsum</i></h4></p>
                            You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                            but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't
                            hold a candle to man.
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    #102439	<b>Geplaatst door:</b> <i>Jack Sparrow</i> op donderdag 23 februari 2017 17:22:28</h3>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">plaats hier een antwoord</h3>
                </div>
                <div class="panel-body">
                    <form class="form-group" action="#" method="post">
                        <textarea required class="form-control" col="8" rows="8" name="name" placeholder="Uw bericht.."></textarea><br>
                        <input type="submit" class="btn btn-primary" class="form-control" name="" value="Verzend">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
      <?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
