<?php require_once("../../includes/tools/security.php");
//Pagination variables
$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;
?>
<?php
$aantal = $page * $perPage - $perPage;

$search = $_GET['q'];
$sql = $dbc->prepare("SELECT * ,u.id AS user_created_topic ,sc.id AS sub_id , t.id , sc.name AS sub_name, t.created_at AS topic_created_at FROM topic AS t JOIN topic_permission AS tp ON tp.topic_id = t.id LEFT JOIN reply AS r ON t.id = r.topic_id JOIN user AS u ON t.user_id = u.id JOIN state AS s ON t.state_id = s.id JOIN sub_category AS sc ON t.sub_category_id = sc.id WHERE tp.role_id = :role_id AND t.sub_category_id = :sub_id AND (t.title LIKE :search OR t.content LIKE :search OR r.content LIKE :search) GROUP BY t.id ORDER BY r.created_at DESC, t.created_at DESC LIMIT {$perPage} OFFSET {$aantal};");
$sql->execute([":search" => isset($search) ? "%" . $search . "%" : "%", ":role_id" => $_SESSION['user']->role_id, ":sub_id" => $_GET['id']]);
$results = $sql->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
      <?php if ($logged_in) :?>
      <div class="row columns">
          <div class="col-md-12">
              <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/forum/">Forum</a></li>
                  <li><a href="/forum/topic/<?php echo $_GET['name']; ?>"><?php echo $_GET['id']; ?></a></li>
                  <li class="active">Zoek op topics</li>
              </ol>
          </div>
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Zoekresultaten</div>
           <div class="panel-body padding-padding table-responsive">
            <table>
              <?php if(sizeof($results) === 0):?>
                <tr>
                    <td>Er zijn geen resultaten gevonden</td>
                  </tr>
              <?php else : ?>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Titel</th>
                  <th>Auteur</th>
                  <th>Berichten</th>
                  <th>Laatste bericht</th>
                </tr>
              </thead>
              <tbody>
              <?php endif; ?>

                <?php foreach ($results as $key => $value) : ?>
                <?php
                  $sth = $dbc->prepare("SELECT count(*) as amount FROM reply WHERE topic_id = :id");
                  $sth->execute([":id" => $value->id]);
                  $amount = $sth->fetch(PDO::FETCH_OBJ)->amount;
                ?>
                  <tr>
                    <td>
                      <?php
                        switch ($value->state_id) {
                        case 1:
                          echo "<span class='glyphicon glyphicon-file'></span>";
                          break;
                        case 2:
                          echo "<span class='glyphicon glyphicon-lock'></span>";
                          break;
                        case 3:
                          echo "<span class='glyphicon glyphicon-pushpin'></span>";
                          break;
                        }
                      ?>
                    </td>
                    <td><a href="/forum/post/<?php echo $value->id; ?>"><?php echo $value->title; ?></a></td>
                    <td><a href="/user/<?php echo $value->user_created_topic; ?>"><?php echo $value->first_name .' '. $value->last_name; ?></a></td>
                    <td><?php echo $amount + 1; ?></td>
                    <td><?php echo $value->topic_created_at; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
           </div>
         </div>
        </div>
      <?php endif; ?>
      <?php
      // $ad_in_row = true;
      require_once('../../includes/components/advertentie.php'); ?>
    </div>
    <?php
        $path = "/forum/search/:page";
        $sql = "SELECT count(t.id) AS x FROM topic AS t LEFT JOIN reply AS r ON t.id = r.topic_id JOIN user AS u ON t.user_id = u.id JOIN state AS s ON t.state_id = s.id JOIN sub_category AS sc ON t.sub_category_id = sc.id WHERE t.title LIKE :search OR t.content LIKE :search OR r.content LIKE :search GROUP BY t.id ORDER BY r.created_at DESC, t.created_at DESC";
        $pagination_bindings = [":search" => isset($search) ? "%" . $search . "%" : "%"];
        require_once("../../includes/components/pagination.php");
    ?>
    </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
