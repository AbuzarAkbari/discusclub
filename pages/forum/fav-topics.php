<?php require_once("../../includes/tools/security.php");
//Pagination variables
$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;
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
    <?php
    $aantal = $page * $perPage - $perPage;
    // $sql = "SELECT *, t.id AS topic_id, user.id AS user_id, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name FROM favorite as f JOIN topic as t ON f.topic_id = t.id JOIN user ON f.user_id = user.id JOIN sub_category ON t.sub_category_id = sub_category.id WHERE f.user_id = :user_id LIMIT {$perPage} OFFSET {$aantal}";
    // $result = $dbc->prepare($sql);
    // $result->execute([":user_id" => $_SESSION["user"]->id]);
    // $results = $result->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT *, t.id AS topic_id, user.id AS user_id, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name, t.id, t.last_changed as topic_last_changed FROM favorite as f JOIN topic as t ON f.topic_id = t.id JOIN user ON f.user_id = user.id JOIN sub_category ON t.sub_category_id = sub_category.id WHERE f.user_id = :user_id AND t.deleted_at IS NULL AND state_id = 3 LIMIT {$perPage} OFFSET {$aantal}";
    $sth = $dbc->prepare($sql);
    $sth->execute([":user_id" => $_SESSION["user"]->id]);
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT *, t.id AS topic_id, user.id AS user_id, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name, t.id, t.last_changed as topic_last_changed FROM favorite as f JOIN topic as t ON f.topic_id = t.id JOIN user ON f.user_id = user.id JOIN sub_category ON t.sub_category_id = sub_category.id WHERE f.user_id = :user_id AND t.deleted_at IS NULL AND state_id <> 3 LIMIT {$perPage} OFFSET {$aantal}";
    $sth = $dbc->prepare($sql);
    $sth->execute([":user_id" => $_SESSION["user"]->id]);

    $results = array_merge($results, $sth->fetchAll(PDO::FETCH_ASSOC));
?>
<br><br>
<div class="container main">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/forum/">Forum</a></li>
                    <li class="active">Favoriete topics</li>
                </ol>
            </div>
            <div class="panel panel-primary ">
                <div class="panel-heading border-colors">Favoriete topics</div>
                <div class="panel-body padding-padding table-responsive">
                    <table>
                        <tr>
                            <th> #</th>
                            <th> Titel</th>
                            <th>Forum</th>
                            <th>Auteur</th>
                            <th>Berichten</th>
                            <th>Bekeken</th>
                            <th>Laatste bericht</th>
                        </tr>
                        <?php foreach ($results as $topic) : ?>
                            <?php

                            $sql3 = "SELECT COUNT(id) AS i FROM reply WHERE topic_id = ?";
                            $result3 = $dbc->prepare($sql3);
                            $result3->bindParam(1, $topic['id']);
                            $result3->execute();

                            $results2 = $result3->fetch(PDO::FETCH_ASSOC);

                            $sql4 = "SELECT COUNT(*) AS x FROM view WHERE topic_id = ?";
                            $result4 = $dbc->prepare($sql4);
                            $result4->bindParam(1, $topic['id']);
                            $result4->execute();
                            $x_bekeken = $result4->fetchAll()[0];
                            ?>

                            <tr>
                                <td>
                                    <?php
                                    switch ($topic['state_id']) {
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
                                <td><a href="/forum/post/<?php echo $topic['topic_id']; ?>"><?php echo $topic['title']; ?></a></td>
                                <td><a href="/forum/topic/<?php echo $topic['sub_category_id']; ?>"><?php echo $topic['sub_category_name']; ?></a></td>
                                <td><a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>

                                <td><?php echo $results2['i']; ?></td>
                                <td><?php echo $x_bekeken['x']; ?></td>
                                <?php
                                $userResult = $dbc->prepare("SELECT *, u.id as user_id, r.last_changed FROM reply as r JOIN topic as t ON t.id = r.topic_id JOIN user as u ON u.id = r.user_id WHERE t.id = :id ORDER BY r.last_changed DESC LIMIT 1 ");
                                $userResult->execute([":id" => $topic["id"]]);
                                $user = $userResult->fetch(PDO::FETCH_ASSOC);
                                if($user) :
                                ?>
                                    <td><?php echo $topic['topic_last_changed']; ?>, <br> Door <a href="/user/<?php echo $user["user_id"]; ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></td>
                                <?php else : ?>
                                    <td><?php echo $topic['topic_last_changed']; ?>, <br> Door <a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </div>
                </table>
            </div>
            <?php
            $path = "/forum/fav-topics/:page";
            $sql = "SELECT COUNT(*) AS x FROM favorite WHERE user_id = :user_id";
            $pagination_bindings = [":user_id" => $_SESSION["user"]->id];
            require_once("../../includes/components/pagination.php");
            ?>
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
