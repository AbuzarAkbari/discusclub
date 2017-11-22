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
        $topicContent = $_POST['add_topic_content'];

        $sql = "INSERT INTO news (sub_category_id, title, content, created_at) VALUES (:subId, :topicTitle, :topicContent, NOW())";

        $result = $dbc->prepare($sql);

        $result->bindParam(':subId', $subId);
        $result->bindParam(':topicTitle', $topicTitle);
        $result->bindParam(':topicContent', $topicContent);

        $result->execute();

        $lastId = $dbc->lastInsertId();

        // Nieuws permissions
        $newsPermissionSql = "INSERT INTO news_permission (news_id, role_id) SELECT :id, id FROM role";
        $newsPermissionQuery = $dbc->prepare($newsPermissionSql);
        $newsPermissionQuery->execute([":id" => $lastId]);
    }

}
if(!empty($_POST['role'])) {

    $wijzigpermissieSQL = "DELETE FROM news_permission WHERE news_id = :id";
    $wijzigpermissieResult = $dbc->prepare($wijzigpermissieSQL);
    $wijzigpermissieResult->execute([':id' => $_POST['id']]);
    $bindings = [':id' => $_POST['id']];
    $wijzigpermissieSQL = "INSERT INTO news_permission (news_id, role_id) VALUES ";
    $wijzigpermissieSQLS = [];
    foreach ($_POST['role'] as $key => $role) {
        $wijzigpermissieSQLS[] .= "(:id, :role_$key)";
        $bindings[":role_$key"] = $role;
    }
    $wijzigpermissieSQL .= implode(", ", $wijzigpermissieSQLS);
    $wijzigpermissieResult = $dbc->prepare($wijzigpermissieSQL);
    $wijzigpermissieResult->execute($bindings);
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
                                        <input type="text" class="form-control" name="add_topic_title" minlength="3" maxlength="35" placeholder="Titel (max. 35 tekens)" required>
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
                                    <textarea required class="form-control editor" col="8" rows="8" name="add_topic_content" style="resize: none;" maxlength="50" placeholder="Uw bericht.."></textarea>
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
                                <?php if(in_array($current_level, $admin_levels)) : ?>
                                    <th>Admin tools</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = $page * $perPage - $perPage;
                            $sth = $dbc->prepare("SELECT n.id, sc.id as cat_id, sc.name as sub_name, n.title, n.created_at FROM news as n JOIN news_permission AS np ON np.news_id = n.id JOIN sub_category as sc ON n.sub_category_id = sc.id WHERE np.role_id = :role_id ORDER BY n.created_at DESC LIMIT {$perPage} OFFSET {$a}");
                            $sth->execute([":role_id" => $_SESSION['user']->role_id]);
                            $res = $sth->fetchAll(PDO::FETCH_OBJ);
                            if(!empty($res)) :
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
                                    <?php if($logged_in && in_array($current_level, $admin_levels)) : ?>
                                        <td>
                                        <a title="Verwijder" href="/includes/tools/news/del.php?id=<?php echo $value->id; ?>" type="button" class="btn btn-primary " name="button"><i class="glyphicon glyphicon-remove-sign"></i></a>

                                            <!-- Button trigger modal -->
                                            <button type="button" data-id="<?php echo $value->id;?>" class="btn btn-primary change-button">
                                                <i class="buttonDelete glyphicon glyphicon-pencil"></i>
                                            </button>

<!--                                            <a title="Wijzig permissie" href="/includes/tools/news/wijzig.php?id=--><?php //echo $value->id; ?><!--" type="button" class="btn btn-primary " name="button"><i class="glyphicon glyphicon-pencil"></i></a>-->
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php } ?>
                            <?php else : ?>
                            <tr><td>Geen nieuws gevonden</td></tr>
                            <?php endif ;?>

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
                if(!empty($res)) :
                foreach($res as $key => $value) : ?>
                <a href="/album/post/<?php echo $value['album_id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12"><?php echo $value['title'] ?></a><br><?php echo $value['album_reply_created_at'] ?></div>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td>Geen reacties op albums gevonden</td></tr>
                <?php endif ;?>
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

                if(!empty($res)) :
                foreach($res as $key => $value) : ?>
                <a href="/forum/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 "><?php echo $value['title'] ?></a><br><?php echo $value['created_at'] ?></div>
                <?php endforeach; ?>
                <?php else : ?>
                <tr><td>Geen reacties op topics gevonden</td></tr>
                <?php endif ;?>
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

                        if(!empty($res)) :
                        foreach($res as $key => $value) : ?>
                        <a href="/news/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 "><?php echo $value['title'] ?></a><br><?php echo $value['news_reply_created_at'] ?></div>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr><td>Geen reacties op nieuws gevonden</td></tr>
                        <?php endif ;?>
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
                      $sth = $dbc->prepare("SELECT *, album.id AS album_id FROM album JOIN image ON image.album_id = album.id GROUP BY image.album_id ORDER BY created_at DESC LIMIT 6");
                      $sth->execute();
                      $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                      if(!empty($res)) :
                      foreach($res as $key => $value) : ?>
                      <div class=" col-md-4 col-sm-4 ruimte"><a href="/album/post/<?php echo $value["album_id"]; ?>"><div  title="image album" class="imgThumbnail" style="background-image: url('/images<?php echo $value['path']?>');"></div></a><br><?php echo $value['created_at']?></div>
                      <?php endforeach; ?>
                      <?php else : ?>
                        <tr><td>Geen albums gevonden</td></tr>
                        <?php endif ;?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php require_once("../../includes/components/summernote.php"); ?>
    <script>
        $(".change-button").on("click", function () {
            var id = $(this).data('id');
            $('#myModal').modal('show');

            fetch(`/includes/tools/news/wijzig?id=${id}`)
                .then(res => res.text())
        .then(res => $(".modal-dialog").html(res))
        });
    </script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

    </div>
</div>
