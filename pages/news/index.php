<?php $levels = ["lid", "gebruiker"]; ?>
<?php require_once("../../includes/tools/security.php");

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 5;

if (isset($_POST['post_add_topic'])) {
    if ($logged_in && in_array($current_level, ["redacteur", "admin"])) {
        $subId = $_POST['sub_category'];
        $topicTitle = htmlentities($_POST['add_topic_title']);
        $topicAuteur = $_SESSION['user']->id;
        $topicContent = $_POST['content'];

        $sql = "INSERT INTO news (sub_category_id, title, content, created_at) VALUES (:subId, :topicTitle, :topicContent, NOW())";

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
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
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
        <div class="col-md-12">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Nieuws</li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                <div class="panel-heading border-colors">
                    <h3 class="panel-title">Zoek nieuws</h3>
                </div>
                    <div class="panel-body">
                        <form method="get" action="/news/search">
                            <input type="text" class="form-control" name="q" placeholder='Zoek in het nieuws..' maxlength="155" required ><br>
                            <button type="submit" class="form-control btn btn-primary">Zoek nieuws</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($logged_in && in_array($current_level, ["redacteur", "admin"])) :?>
            <div class="row col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading border-colors">
                            <h3 class="panel-title">Nieuws toevoegen</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="/news/" method="post">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="add_topic_title" minlength="3" maxlength="50" placeholder="Titel (max. 50 tekens)">
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
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <?php require_once('../../includes/components/summernote.php') ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="form-control btn btn-primary" class="form-control" name="post_add_topic"
                                    value="Toevoegen">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-7">
        <div class="col-md-12">
            <div class="panel panel-primary" id="news">
                <div class="panel-heading border-colors">Nieuws</div>
                <div class="panel-body padding-padding table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Titel</th>
                                <th>Reacties</th>
                                <th>Categorie</th>
                                <th>Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = $page * $perPage - $perPage;
                            $sth = $dbc->prepare("SELECT n.id, sc.id as cat_id, sc.name as sub_name, n.title, n.created_at FROM news as n JOIN sub_category as sc ON n.sub_category_id = sc.id LIMIT {$perPage} OFFSET {$a}");
                            $sth->execute();
                            $res = $sth->fetchAll(PDO::FETCH_OBJ);
                            foreach ($res as $key => $value) { ?>
                                <?php
                                $sth = $dbc->prepare("SELECT count(*) as amount FROM news_reply WHERE news_id = :id");
                                $sth->execute([":id" => $value->id]);
                                $amount = $sth->fetch(PDO::FETCH_OBJ)->amount;
                                ?>
                                <tr>
                                    <td><a href="/news/post/<?php echo $value->id; ?>"><?php echo $value->title; ?></a></td>
                                    <td><?php echo $amount; ?></td>
                                    <td><a href="/forum/topic/<?php echo $value->cat_id; ?>"><?php echo $value->sub_name; ?></a></td>
                                    <td><?php echo $value->created_at; ?></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <?php
                $path = "/news/:page";
                $sql = "SELECT COUNT(*) AS x FROM news WHERE deleted_at IS NULL";
                require_once("../../includes/components/pagination.php");
                ?>
            </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading border-colors">Laatste reacties op albums</div>
            <div class="panel-body">
                <?php
                $sth = $dbc->prepare("SELECT *, album_reply.created_at AS album_reply_created_at FROM album_reply JOIN album ON album_reply.album_id = album.id ORDER BY album_reply.created_at DESC LIMIT 5");
                $sth->execute();
                $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                foreach($res as $key => $value) : ?>
                <a href="/album/post/<?php echo $value['album_id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12"><?php echo $value['title'] ?></a><br><?php echo $value['album_reply_created_at'] ?></div>
                <?php endforeach; ?>
          </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading border-colors">Laatste reacties op topics</div>
            <div class="panel-body">
                <?php
                $sth = $dbc->prepare("SELECT * FROM topic ORDER BY created_at DESC LIMIT 5");
                $sth->execute();
                $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                foreach($res as $key => $value) : ?>
                <a href="/forum/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 "><?php echo $value['title'] ?></a><br><?php echo $value['created_at'] ?></div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">Laatste reacties op nieuws</div>
                <div class="panel-body">
                    <?php
                        $sth = $dbc->prepare("SELECT *, news_reply.created_at AS news_reply_created_at FROM news_reply JOIN news ON news_reply.news_id = news.id ORDER BY news_reply.created_at DESC LIMIT 5");
                        $sth->execute();
                        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                        foreach($res as $key => $value) : ?>
                        <a href="/news/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 "><?php echo $value['title'] ?></a><br><?php echo $value['news_reply_created_at'] ?></div>
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">Advertentie</div>
                <div class="panel-body">
                   <div class="col-md-12 col-sm-12 ruimte"><a href="/wordlid"><img alt="Advertentie" src="/images/ad/advertentie.jpg"></div></a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">Bekijk de nieuwste albums</div>
                <div class="panel-body">
                  <?php
                      $sth = $dbc->prepare("SELECT *, album.id AS album_id FROM album JOIN image ON image.album_id = album.id ORDER BY created_at DESC LIMIT 6");
                      $sth->execute();
                      $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                      foreach($res as $key => $value) : ?>
                      <div class=" col-md-4 col-sm-4 ruimte"><a href="/album/post/<?php echo $value["album_id"]; ?>"><div  title="image album" class="imgThumbnail" style="background-image: url('/images<?php echo $value['path']?>');"></div></a><br><?php echo $value['created_at']?></div>
                      <?php endforeach; ?>
              </div>
            </div>
        </div>
    </div>
    <?php require ('../../includes/components/advertentie.php'); ?>

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
