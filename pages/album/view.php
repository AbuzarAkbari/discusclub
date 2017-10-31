<?php
$levels = ["gast", "lid", "gebruiker"];
require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
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
    <div class="container">
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

        <?php
            $sql2 = "SELECT *, album_reply.created_at AS reply_created_at FROM album_reply JOIN user ON album_reply.user_id = user.id WHERE album_id = ?";
            $result2 = $dbc->prepare($sql2);
            $result2->bindParam(1, $_GET['id']);
            $result2->execute();
            $rows = $result2->fetchAll(PDO::FETCH_ASSOC);
        ?>

             <?php foreach ($rows as $row) : ?>
                 <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading border-color-blue">
                        <h3 class="panel-title text-left"><?php echo "Geplaatst door: " .  $row['first_name'].' '.$row['last_name']; ?></h3>

                    </div>

                    <div class="panel-body padding-padding ">
                        <div class="col-md-12 ">
                            <div class="col-md-2">
                                <img src='http://via.placeholder.com/130x130' alt="">
                            </div>
                            <div class="col-md-10 ">
                                <p><?php echo html_entity_decode($row['content']); ?></p>
                            </div>
                        </div>

                    </div>


                    <div class="panel-footer">


                op
                <?php echo $row['reply_created_at']; ?>
                </h3>
                <div class="pull-right">

                    <button class="btn btn-primary quote-btn" data-id="<?php echo $row2['id']; ?>">
                        Quote deze post
                    </button>
                </div>

                <div class="clearfix"></div>
                </div>
            </div>
            </div>

                    <?php endforeach; ?>

<<<<<<< HEAD


                        <div class="pull-right">
=======
>>>>>>> 60ff26c151fb1a4c32b1f6642cd904355144e4e9




<<<<<<< HEAD
                    </div>
=======
>>>>>>> 60ff26c151fb1a4c32b1f6642cd904355144e4e9

                <?php if ($logged_in) : ?>
                    <div class="col-xs-12">
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

        <br>
        <footer>
            <?php require_once("../../includes/components/footer.php") ; ?>
        </footer>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
    <!-- summer note -->
    <!-- summernote js -->
    <!-- script type="text/javascript" src="/js/summernote.min.js"></script>
    <script>
        $('.editor').summernote({
            disableResizeEditor: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $(document).ready(function () {
            $('.quote-btn').on('click', function () {
                $('.editor').summernote('insertText', '[quote '+($(this).attr('data-id'))+']')//.disabled = true
            });
        });
    </script> -->
</body>
</html>
