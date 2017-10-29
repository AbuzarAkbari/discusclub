<?php require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">
    <link rel="stylesheet" href="/css/albums.css">
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
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading border-color-blue">
                    <h3 class="panel-title">Album toevoegen</h3>
                  </div>
                  <div class="panel-body">
                    <a href="/album/upload" type="button" class="btn btn-primary col-md-12 " name="button">Upload een album</a>
                  </div>
                </div>
            </div>

            <?php
              $haal_albums = "SELECT DISTINCT *, COUNT(album_has_image.album_id) AS aantal_fotos, user.id as user_id FROM album LEFT JOIN album_has_image ON album.id = album_has_image.album_id JOIN user ON album.user_id = user.id JOIN image ON album_has_image.image_id = image.id GROUP BY album.id ";

              $albumResult = $dbc->prepare($haal_albums);
              $albumResult->execute();
              $albums = $albumResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <?php foreach ($albums as $album) : ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading border-color-blue">
                        <h3 class="panel-title"><?php echo $album['title']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><b>Geplaatst door: </b><a href="/user/<?php echo $album["user_id"]; ?>"><i> <?php echo $album['first_name'].' '.$album['last_name']; ?> </i></a></h4>
                                <p>
                                    Aantal foto's: <i><?php echo $album['aantal_fotos']; ?></i><br>
                                    Datum: <i><?php echo $album['created_at']; ?></i><br>
                                </p>
                                <div class="text-center"><img class="text-center imgAlbum" src="<?php echo $album['path'] ?>" alt=""></div><br><br>
                                <button type="button" class="btn btn-primary" name="button">Bekijken</button></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
  </div>
</div>
  <br>
  <br>
  <br>
    <footer>
    <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
