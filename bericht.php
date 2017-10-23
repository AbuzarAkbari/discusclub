<?php require_once('dbc.php'); ?>

<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$sql = "INSERT INTO ips (topic_id, user_id, ip_adres, created_at) VALUES ({$_GET['id']}, 1, '{$ip}', NOW())";
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

<div class="container" style="margin-top:25px;">

    <div class="row">
        <div class="col-md-12">
            <?php
            $sql = "SELECT * FROM topic WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_GET['id']);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($rows as $row) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-left"><?php echo $row['title']; ?></h3>

                    <div class="pull-right">
                        <input type="submit" class="btn btn-primary" name="send" value="Favoriete">
                        <input type="submit" class="btn btn-primary" name="send" value="Button 1">
                        <input type="submit" class="btn btn-primary" name="send" value="Button 2">
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="">
                        </div>
                        <div class="col-md-10">
                            <?php echo $row['content']; ?>
                        </div>
                    </div>

                </div>

                <div class="panel-footer">
                    <p class="text-left">
                        <b>Geplaatst door:</b> <i><?php echo $row['user_id']; ?></i>
                        op <?php echo $row['created_at']; ?>
                    </p>
                </div>

                <?php endforeach; ?>



            </div>

            <?php
            $sql2 = "SELECT * FROM reply WHERE topic_id = ?";
            $result2 = $dbc->prepare($sql2);
            $result2->bindParam(1, $_GET['id']);
            $result2->execute();
            $rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($rows2 as $row2) : ?>
                <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="wrapper-box col-md-12">
                        <div class="wrapper-box col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="x">
                        </div>
                        <div class="col-md-10">
                            <p><?php echo $row2['content']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <p class="text-left">
                        <b>Geplaatst door:</b> <i><?php echo $row2['user_id']; ?></i>
                        op <?php echo $row2['created_at']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
     </div>
    </div>

</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">

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
    </div>
    <div class="row">
        <div class="col-md-12">
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