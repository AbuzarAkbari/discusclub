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
    <link rel="stylesheet" href="/css/overons.css">
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
      <div class="row">

      <div class="col-md-8">
        <div class="panel panel-primary">
          <div class="panel-heading border-color-blue">Over Discus Club Holland</div>
          <div class="panel-body padding-padding space">
              <li class="overonsHover"><a href="/about">Het ontstaan van Discus Club Holland</a></li>
              <li class="overonsHover"><a href="/about/news">Nieuwsberichten​</a></li>
          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Advertentie</div>
              <div class="panel-body">
                  <div class="col-md-12 col-sm-12 ruimte"><img src="/images/ad/26-4d40233b-91a4-404c-8ff1-077653609f35.jpg"> </div>
              </div>
          </div>
      </div>
      <div class="col-md-8"> </div>

      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Bekijk de nieuwste albums</div>
              <div class="panel-body">
                  <?php
                      $sth = $dbc->prepare("SELECT * FROM album_reply JOIN image ON image.album_id = album_reply.album_id JOIN album ON album_reply.album_id = album.id  LIMIT 6");
                      $sth->execute();
                      $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                      foreach($res as $key => $value) : ?>
                        <div class="col-md-4 col-sm-4 ruimte"><a href="/album/<?php echo $value["album_id"]; ?>"></a><img src="<?php echo $value['path']; ?>"></div>
                      <?php endforeach; ?>
              </div>
          </div>
      </div>
      <div class="col-md-8"> </div>
            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading border-colors">Laatste reacties op albums</div>
                <div class="panel-body">
                    <?php
                        $sth = $dbc->prepare("SELECT * FROM album_reply JOIN image ON image.album_id = album_reply.album_id JOIN album ON album_reply.album_id = album.id LIMIT 5");
                        $sth->execute();
                        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                        foreach($res as $key => $value) : ?>
                            <div class="col-md-4 col-sm-4 laastenieuws"><span class="blauwtxt"><a href="/album/<?php echo $value["album_id"]; ?>"><img src="<?php echo $value['path']; ?>">
                            </span></a><b><?php echo $value['title'];?></b><br><?php echo $value['created_at']; ?></div>
                        <?php endforeach; ?>
                </div>
              </div>
            </div>
      <div class="col-md-8"> </div>
      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Laatste reacties op nieuws</div>
          <div class="panel-body">
                <?php
                    $sth = $dbc->prepare("SELECT * FROM news_reply JOIN news ON news_id = news.id LIMIT 5");
                    $sth->execute();
                    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                    foreach($res as $key => $value) : ?>
                        <a href="/about/news/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 laastenieuws"><?php echo $value['title'] ?></a><br><?php echo $value['created_at'] ?></div>
                    <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="col-md-8"> </div>
      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Laatste reacties op topics</div>
          <div class="panel-body">
              <?php
                  $sth = $dbc->prepare("SELECT * FROM topic ORDER BY created_at LIMIT 5");
                  $sth->execute();
                  $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                  foreach($res as $key => $value) : ?>
                      <a href="/forum/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 laastenieuws"><?php echo $value['title'] ?></a><br><?php echo $value['created_at'] ?></div>
                  <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
    <footer>
    <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
