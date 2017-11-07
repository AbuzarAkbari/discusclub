<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");

//var_dump($_GET);

//Pagination variables
$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;

//echo '<pre>';
//print_r(
//    $_GET);
//exit;
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

    <?php require_once("../../includes/components/nav.php"); ?>

    <br><br>
    <?php
    $aantal = $page * $perPage - $perPage;
    $sql = "SELECT *, user.id AS user_id, topic.id AS topic_id, sub_category.id AS sub_category_id FROM topic JOIN sub_category ON topic.sub_category_id = sub_category.id JOIN user ON topic.user_id = user.id WHERE topic.last_changed >= DATE(NOW()) - INTERVAL 7 DAY ORDER BY topic.created_at DESC LIMIT {$perPage} OFFSET {$aantal}";
    $result = $dbc->prepare($sql);
    $result->execute();
    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<br><br>
<div class="container main">
    <div class="row columns">
        <div class="col-md-12">
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/forum/">Forum</a></li>
                    <li class="active">Actieve topics</li>
                </ol>
            </div>
            <div class="panel panel-primary ">
                <div class="panel-heading border-colors">Actieve topics</div>
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
                            <?php if (in_array($current_level, $admin_levels)) : ?>
                                <th>Admin tools</th>
                            <?php endif; ?>
                        </tr>
                        <?php foreach ($result2 as $topic) : ?>
                            <?php
                                $id = 1;

                                $sql2 = "SELECT * FROM sub_category WHERE category_id = ?";
                                $result2 = $dbc->prepare($sql2);
                                $result2->bindParam(1, $id);
                                $result2->execute();

                                $sub_categorie_naam = $result2->fetchAll(PDO::FETCH_ASSOC);

                                $sql3 = "SELECT COUNT(id) AS i FROM reply WHERE topic_id = ?";
                                $result3 = $dbc->prepare($sql3);
                                $result3->bindParam(1, $topic['id']);
                                $result3->execute();

                                $results2 = $result3->fetchAll(PDO::FETCH_ASSOC);

                                    $sql4 = "SELECT COUNT(*) AS x FROM view WHERE topic_id = ?";
                                    $result4 = $dbc->prepare($sql4);
                                    $result4->bindParam(1, $topic['id']);
                                    $result4->execute();
                                    $x_bekeken = $result4->fetchAll()[0];
                                ?>

                            <tr>
                                <td><?php echo "<span class='glyphicon glyphicon-file'></span>"; ?></td>
                                <td><a href="/forum/post/<?php echo $topic['topic_id']; ?>"><?php echo $topic['title']; ?></a></td>
                                <td><a href="/forum/topic/<?php echo $topic['sub_category_id']; ?>"><?php echo $sub_categorie_naam[0]['name']; ?></a></td>
                                <td><a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>

                                <td><?php echo $results2[0]['i']; ?></td>
                                <td><?php echo $x_bekeken['x']; ?></td>
                                <!-- Hier laatste bericht nog aanpassen -->
                                <td>1 dag geleden, <br> Door <a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>
                                <?php if (in_array($current_level, $admin_levels)) : ?>
                                <td>
                                    <a  title="Open" href="/includes/tools/topic/default.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $sub_categorie_naam['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-file"></i></a>
                                    <a  title="Pinnen" href="/includes/tools/topic/pin.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $sub_categorie_naam['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-pushpin"></i></a>
                                    <a  title="Locken" href="/includes/tools/topic/lock.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $sub_categorie_naam['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-lock" ></i></a>
                                    <a title="Bewerken" href="/includes/tools/topic/edit.php?id=<?php echo $topic['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-edit" ></i></a>
                                    <a title="Verwijderen" href="/includes/tools/topic/del.php?id=<?php echo $topic['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-remove-sign" ></i></a>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </div>
                </table>
            </div>
            <!-- Pagination system -->
            <div class="col-xs-12">

                <?php

                $query = $dbc->prepare('SELECT COUNT(*) AS x FROM topic WHERE topic.last_changed >= DATE(NOW()) - INTERVAL 7 DAY AND deleted_at IS NULL');
                $query->execute([
                    ':id' => $page
                ]);
                $results = $query->fetchAll()[0];
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
                                    <a href="/forum/active-topics/<?php echo $x; ?>"><?php echo $x; ?></a>
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
</div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
