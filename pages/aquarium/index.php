<?php
// $levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php"); ?>
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
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Aquarium</li>
                    </ol>
                </div>
                <div class="panel panel-primary">
                  <div class="panel-heading border-color-blue">
                    <h3 class="panel-title">Aquarium toevoegen</h3>
                  </div>
                  <div class="panel-body">
                    <a href="/aquarium/upload" type="button" class="btn btn-primary col-md-12 " name="button">Upload een aquarium</a>
                  </div>
                </div>
            </div>

            <?php
              $haal_aquariums = "SELECT *, a.created_at AS aquarium_created_at, count(i.aquarium_id) as aantal_fotos, u.id as user_id, a.created_at as created_at FROM image as i JOIN aquarium as a ON a.id = i.aquarium_id JOIN user as u ON u.id = a.user_id WHERE i.aquarium_id IS NOT NULL GROUP BY i.aquarium_id ORDER BY aquarium_created_at DESC";

              $aquariumResult = $dbc->prepare($haal_aquariums);
              $aquariumResult->execute();
              $aquariums = $aquariumResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($aquariums as $aquarium) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading border-color-blue">
                            <h3 class="panel-title"><?php echo $aquarium['title']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><b>Geplaatst door: </b><a href="/user/<?php echo $aquarium["user_id"]; ?>"><i> <?php echo $aquarium['first_name'].' '.$aquarium['last_name']; ?> </i></a></h4>
                                    <p>
                                        Aantal foto's: <i><?php echo $aquarium['aantal_fotos']; ?></i><br>
                                        Datum: <i><?php echo $aquarium['created_at']; ?></i><br>
                                    </p>
                                    <div class="text-center"><img class="text-center imgAlbum" src="/images<?php echo $aquarium['path'] ?>" alt=""></div><br><br>
                                    <a href="<?php echo $aquarium['aquarium_id'] ?>"><button type="button" class="btn btn-primary" name="button">Bekijken</button></b></a>
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