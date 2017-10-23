<?php require_once('dbc.php'); ?>

<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$sql = "INSERT INTO aantal_bekeken (topic_id, user_id, ip_adres, bekeken_op) VALUES ({$_GET['id']}, 1, '{$ip}', NOW())";
$result = $dbc->prepare($sql);
$result->execute();
?>

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
    <!-- summernote css -->
    <link rel="stylesheet" href="css/summernote.css">
</head>

<body>
<<<<<<< HEAD
<div id="fb-root"></div>
<script>
    (function (d, s, id) {
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
<div class="container">
<ol class="breadcrumb">
    <li><a href="#">Forum</a></li>
    <li><a href="#">Mededelingen</a></li>
    <li><a href="#" class="active">Nieuwe website DCH</a></li>
</ol>
</div>
<div class="container text-center">

    <div class="row">
        <div class="col-md-12">
            <?php
            $sql = "SELECT * FROM topics WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_GET['id']);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($rows as $row) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $row['topic_titel']; ?></h3>
=======
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
>>>>>>> eba39912b355e9f8c2cfaa6c8b31fc240777b66e
                </div>

                <div class="panel-body">
                    <div class="wrapper-box col-md-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="">
                        </div>
                        <div class="col-md-10">
<<<<<<< HEAD
                            <p><?php echo $row['topic_content']; ?></p>
=======
                            <p>
                            <h4>Titel</h4></p>
                            You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                            but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't
                            hold a candle to man.
>>>>>>> eba39912b355e9f8c2cfaa6c8b31fc240777b66e
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
<<<<<<< HEAD
                    <b>Geplaatst door:</b> <i><?php echo $row['topic_auteur']; ?></i>
                    op <?php echo $row['post_datum']; ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
            <?php
                $sql2 = "SELECT * FROM reply WHERE topic_id = ?";
                $result2 = $dbc->prepare($sql2);
                $result2->bindParam(1, $_GET['id']);
                $result2->execute();
                $rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($rows2 as $row2) : ?>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="wrapper-box col-md-12">
                            <div class="col-md-2">
                                <img src='http://via.placeholder.com/130x130' alt="x">
                            </div>

                            <div class="col-md-10">
                                <p><?php echo $row2['reply_content']; ?></p>
                            </div>
=======
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
>>>>>>> eba39912b355e9f8c2cfaa6c8b31fc240777b66e
                        </div>
                    </div>
                    <div class="panel-footer">
                        <b>Geplaatst door:</b> <i><?php echo $row2['reply_auteur']; ?></i>
                        op <?php echo $row2['reply_datum']; ?></h3>
                    </div>
                </div>
<<<<<<< HEAD
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
=======
                <div class="panel-footer">
                    #102439	<b>Geplaatst door:</b> <i>Jack Sparrow</i> op donderdag 23 februari 2017 17:22:28</h3>
                </div>
            </div>
>>>>>>> eba39912b355e9f8c2cfaa6c8b31fc240777b66e
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Antwoord toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="berichtParse.php" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea required class="form-control editor" col="8" rows="8" name="reply_content"
                                       style="resize: none;" placeholder="Uw bericht.."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="hidden" name="bericht_id" value="<?php echo $_GET['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" class="form-control" name="post_reply"
                                       value="Plaats reactie">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <?php require 'footer.php'; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- summernote js -->
<script type="text/javascript" src="js/summernote.min.js"></script>
<script>
    $('.editor').summernote({
        codemirror: {
            theme: 'yeti'
        }
    });
</script>
</body>

</html>
