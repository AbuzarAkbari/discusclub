<?php require_once("includes/security.php");
require_once('dbc.php'); ?>
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
    require_once("includes/nav.php");
    ?>
    <div class="container-fluid">
        <div class="row sliderbox">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/vissen1.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen2.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen3.jpg" alt="vissen">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="container main">
        <div class="row">
            <?php
                $sql = "SELECT * FROM topics WHERE id = {$_GET['id']}";
                $result = mysqli_query($dbc, $sql);
            ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="alert alert-success" style="background-color: black; color: white;"><?php echo $row['topic_titel']; ?></div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">geplaatst door <?php echo $row['topic_auteur']; ?></h3>
                </div>
                <?php endwhile; ?>
                <div class="panel-body">
                    <div class="wrapper-box col-md-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="">
                        </div>
                        <div class="col-md-10">
                            <p>
                                <h4>title</h4></p>
                            You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                            but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't
                            hold a candle to man.
                        </div>

                    </div>

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
                    <div>
                    </div>
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
