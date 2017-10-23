<?php require_once('dbc.php'); ?>
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
    <div class="header">
        <div class="container">
      <div class="inlog">
          <a href="inloggen.php">Inloggen</a>
          <a href="registeren.php">Registreer</a>
          <a href="wachtwoordvergeten.php">Wachtwoord vergeten?</a>
      </div>
        <div class="col-xs-6">
            <img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland">
        </div>
        </div>
    </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>
            </div>
<?php require 'nav_uitloggen.php'; ?>
            <!--/.nav-collapse -->
        </div>
    </nav>
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
    <br><br>
<?php
   $sql = "SELECT * FROM topics";
   $result = $dbc->prepare($sql);
   $result->execute();
   $results = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<br><br>
<div class="container">
    <div class="row columns">
        <div class="col-md-12">
            <div class="panel panel-primary ">
                <div class="panel-heading border-colors">Nieuwe topics</div>
                <div class="panel-body padding-padding">
                    <table>
                        <tr>
                            <th> #</th>
                            <th> Titel</th>
                            <th>Forum</th>
                            <th>Auteur</th>
                            <th>Berichten</th>
                            <th>Bekeken</th>
                            <th>Laatste bericht</th>
                        </tr>
                        <?php foreach($results as $topic) : ?>
                            <?php
                            $id = 1;

                            $sql2 = "SELECT * FROM sub_category WHERE category_id = ?";
                            $result2 = $dbc->prepare($sql2);
                            $result2->bindParam(1, $id);
                            $result2->execute();

                            $sub_categorie_naam = $result2->fetchAll();

                            $sql3 = "SELECT COUNT(id) AS i FROM berichten WHERE topic_id = ?";
                            $result3 = $dbc->prepare($sql3);
                            $result3->bindParam(1, $topic['id']);
                            $result3->execute();

                            $results2 = $result3->fetchAll(PDO::FETCH_ASSOC);

                            $sql4 = "SELECT COUNT(*) AS x FROM ips WHERE topic_id = ?";
                            $result4 = $dbc->prepare($sql4);
                            $result4->bindParam(1, $topic['id']);
                            $result4->execute();
                            $x_bekeken = $result4->fetchAll()[0];
                            ?>

                            <tr>
                                <td><?php echo $topic['topic_icon']; ?></td>
                                <td><a href="topics.php?id=<?php echo $topic['id']; ?>"><?php echo $topic['topic_titel']; ?></a></td>
                                <td><a href="#"><?php echo $sub_categorie_naam[0]['sub_categorie_naam']; ?></a></td>
                                <td><a href="#"><?php echo $topic['topic_auteur']; ?></a></td>

                                <td><?php echo $results2[0]['i']; ?></td>
                                <td><?php echo $x_bekeken['x']; ?></td>
                                <td>1 dag geleden, <br> Door <a href="#"><?php echo 'John Doe'; ?></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </div>
                </table>
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
