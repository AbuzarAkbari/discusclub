<?php require_once("../../includes/tools/security.php");

if (isset($_POST['post_add_topic'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in && in_array($current_level, ["redacteur", "admin"])) {
        $subId = $_POST['sub_category'];
        $topicTitle = $_POST['add_topic_title'];
        $topicAuteur = $_SESSION['user']->id;
        $topicContent = htmlentities($_POST['add_topic_content']);

        $sql = "INSERT INTO news (sub_category_id, title, content) VALUES (:subId, :topicTitle, :topicContent)";

        $result = $dbc->prepare($sql);

        $result->bindParam(':subId', $subId);
        $result->bindParam(':topicTitle', $topicTitle);
        $result->bindParam(':topicContent', $topicContent);

        $result->execute();

        $lastId = $dbc->lastInsertId();
    }
}

?>
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
      <div class="row columns">
        <?php if ($logged_in && in_array($current_level, ["redacteur", "admin"])) :?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">nieuws toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="add_topic_title" minlength="3" maxlength="50" placeholder="Titel (max. 50 characters)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <select type="text" class="form-control" name="sub_category">
                                    <?php
                                    $sth = $dbc->prepare("SELECT * FROM sub_category");
                                    $sth->execute();
                                    $res = $sth->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($res as $cat) : ?>
                                      <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="add_topic_content"
                                          style="resize: none !important;" placeholder="Uw bericht.."></textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" class="form-control" name="post_add_topic"
                                       value="Toevoegen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
      <div class="col-md-8">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Nieuws</div>
          <div class="panel-body padding-padding table-responsive">
            <table>
              <thead>
                <tr>
                  <th>Titel</th>
                  <th>Reactie</th>
                  <th>Catogorie</th>
                  <th>Datum</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sth = $dbc->prepare("SELECT n.id, sc.id as cat_id, sc.name as sub_name, n.title, n.created_at FROM news as n JOIN sub_category as sc ON n.sub_category_id = sc.id");
                $sth->execute();
                $res = $sth->fetchAll(PDO::FETCH_OBJ);
                foreach ($res as $key => $value) { ?>
                <?php
                $sth = $dbc->prepare("SELECT count(*) as amount FROM news_reply WHERE news_id = :id");
                $sth->execute([":id" => $value->id]);
                $amount = $sth->fetch(PDO::FETCH_OBJ)->amount;
                ?>
                <tr>
                    <td><a href="/about/news/<?php echo $value->id; ?>"><?php echo $value->title; ?></a></td>
                    <td><?php echo $amount; ?></td>
                    <td><a href="categorie.php?id=<?php echo $value->cat_id; ?>"><?php echo $value->sub_name; ?></a></td>
                    <td><?php echo $value->created_at; ?></td>
                </tr>
                <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Laatste reacties op nieuws</div>
          <div class="panel-body">
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Advertentie</div>
              <div class="panel-body">
                  <div class="col-md-12 col-sm-12 ruimte"><img src="http://via.placeholder.com/320x320"> </div>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Bekijk de nieuwste albums</div>
              <div class="panel-body">
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
                  <div class="col-md-4 col-sm-4 ruimte"><img src="http://via.placeholder.com/350x150"> </div>
              </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Laatste reacties op foto's</div>
          <div class="panel-body">
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt"><span href="https://placeholder.com"><img src="http://via.placeholder.com/50x50"></span></a>Lorem IPsum<br>12-09 23:32</div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Laatste reacties op topics</div>
          <div class="panel-body">
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
             <div class="col-md-12 col-sm-12 laastenieuws"><a class="blauwtxt">Lorem ipsum</a><br>12-09 23:32</div>
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
