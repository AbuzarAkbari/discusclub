<?php
require_once("../../includes/tools/security.php");

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 6;
?>
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
                        <li class="active">Aquaria</li>
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
              $a = $page * $perPage - $perPage;
              $haal_aquariums = "SELECT *, a.created_at AS aquarium_created_at, count(i.aquarium_id) as aantal_fotos, u.id as user_id, a.created_at as created_at FROM image as i JOIN aquarium as a ON a.id = i.aquarium_id JOIN user as u ON u.id = a.user_id WHERE a.deleted_at IS NULL GROUP BY i.aquarium_id ORDER BY aquarium_created_at DESC LIMIT {$perPage} OFFSET {$a}";
              $aquariumResult = $dbc->prepare($haal_aquariums);
              $aquariumResult->execute();
              $aquariums = $aquariumResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($aquariums as $aquarium) : ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading border-color-blue row">
                            <div class="col-md-7 col-sm-8 col-xs-8">
                                <h2 class="panel-title aquarium-title"><?php echo $aquarium['title']; ?></h2>
                            </div>
                            <?php
                                $sql = "SELECT COUNT(*) AS x FROM `like` WHERE aquarium_id = :aid";
                                $result = $dbc->prepare($sql);
                                $result->execute([":aid" => $aquarium['aquarium_id']]);
                                $like = $result->fetch();

                                $contestSql = "SELECT count(*) as amount FROM contest WHERE start_at <= :aca AND end_at >= :aca";
                                $contestResult = $dbc->prepare($contestSql);
                                $contestResult->execute([":aca" => $aquarium["aquarium_created_at"]]);
                                $contest = $contestResult->fetch();
                            ?>
                            <?php if(intval($contest["amount"]) > 0) : ?>
                                <div class="col-md-5 col-sm-4 col-xs-4 text-right">
                                    <?php echo isset($like['x']) ? $like['x'] : '0'; ?> <a href="/includes/tools/aquarium/add-like?aid=<?php echo $aquarium['aquarium_id']; ?>"><img class="like-vis" src="/images/favicon-wit.png" alt=""></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><b>Geplaatst door: </b><a href="/user/<?php echo $aquarium["user_id"]; ?>"><i><?php echo $aquarium['first_name'].' '.$aquarium['last_name']; ?> </i></a></h4>
                                    <p>
                                        Aantal foto's: <i><?php echo $aquarium['aantal_fotos']; ?></i><br>
                                        Datum: <i><?php echo $aquarium['created_at']; ?></i><br>
                                    </p>
                                    <div class="text-center"><img class="text-center imgAlbum" src="/images<?php echo $aquarium['path'] ?>" alt=""></div><br><br>
                                    <a href="/aquarium/post/<?php echo $aquarium['aquarium_id'] ?>"><button type="button" class="btn btn-primary" name="button">Bekijken</button></b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Pagination system -->
        <div class="col-xs-12">

            <?php
                $query = $dbc->prepare('SELECT COUNT(*) AS x FROM aquarium WHERE deleted_at IS NULL');
                $query->execute();
                $results = $query->fetch();
                $count = ceil($results['x'] / $perPage);
            ?>
            <?php if ($results['x'] > $perPage) : ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($x = ($count - 4 < 1 ? 1 : $count - 4); $x < ($count + 1); $x++) : ?>
                            <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>>
                                <a href="/album/<?php echo $x; ?>"><?php echo $x; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
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
