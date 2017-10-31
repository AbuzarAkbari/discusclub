<?php
$levels = ["gast", "lid", "gebruiker"];
require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- Slider  -->
        <!-- Add the slick-theme.css if you want default styling -->
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">
    <link rel="stylesheet" href="/css/view.css">
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
    <?php require_once("../../includes/components/nav.php"); ?>

    <br><br>
    <?php
      $id = $_GET['id'];
      $haal_albums = "SELECT * FROM image as i JOIN album as a ON a.id = i.album_id JOIN user as u ON u.id = a.user_id WHERE album_id = ?";

      $albumResult = $dbc->prepare($haal_albums);
      $albumResult->bindParam(1, $id);
      $albumResult->execute();
      $album = $albumResult->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $album[0]['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row sliderbox">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($album as $key => $image) : ?>
                                            <div class="item<?php echo $key == 0 ? " active" : null ?>">
                                                <img src="<?php echo $image['path'] ?>" alt="fishing">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <!-- <li data-target="#myCarousel" data-slide-to="0" class="active"></li> -->
                                    <?php foreach ($album as $image) : ?>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <?php endforeach; ?>
                                    </ol> 

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"> </span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"> </span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <!-- Images -->
                                <?php foreach ($album as $image) : ?>
                                    <div class=" img" style="background-image:url('<?php echo $image['path'] ?>')"; data-target="#myCarousel" data-slide-to="0"></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            
            $sql2 = "SELECT * FROM album_reply WHERE album_id = ?";
            $result2 = $dbc->prepare($sql2);
            $result2->bindParam(1, $_GET['id']);
            $result2->execute();
            $rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        
        <div class="container main">
            <?php foreach ($rows2 as $row2) : ?>
            <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary" id="post-<?php echo $row2['id'] ?>">
                    <div class="panel-body padding-padding table-responsive">
                        <div class="col-md-12 ">
                            <?php echo $row2['content']; ?>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <?php
                        $userSql = "SELECT * FROM user WHERE id = ?";
                        $userResult = $dbc->prepare($userSql);
                        $userResult->bindParam(1, $row2['user_id']);
                        $userResult->execute();
                        $users = $userResult->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($users as $user) : ?>
                            <b>Geplaatst door:</b> <i><a href="#"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></i>
                        <?php endforeach; ?>
                        op <?php echo $row2['created_at']; ?></h3>

                        <div class="pull-right">

                            <button class="btn btn-primary quote-btn" data-id="<?php echo $row2['id']; ?>">
                                Quote deze post
                            </button>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <br>
                    <?php endforeach; ?>

                    </div>
                <?php if ($logged_in) : ?>
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Antwoord op album toevoegen</h3>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" action="/includes/tools/albumParse" method="post">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="reply_content"
                                          style="resize: none;" placeholder="Uw bericht.."></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="hidden" name="album_id" value="<?php echo $_GET['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" class="btn btn-primary" class="form-control" name="post_album_reply"
                                                   value="Plaats reactie">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
          </div>
        </div>
        <br>
        <footer>
            <?php require_once("../../includes/components/footer.php") ; ?>
        </footer>
        <!-- scrollable  -->
        <script src="/js/view.js">scrollable.addEventListener('mousemove', event => {
            console.log(event)
        })
        </script>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
</body>
</html>
