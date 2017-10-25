<?php require_once("includes/security.php");
require_once('dbc.php');
$categorieenSql = "SELECT * FROM category";
$categorieenResult = $dbc->prepare($categorieenSql);
$categorieenResult->execute();
$results = $categorieenResult->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div id="fb-root"></div>
<script>
    ;(function (d, s, id) {
        var js,
            fjs = d.getElementsByTagName(s)[0]
        if (d.getElementById(id)) return
        js = d.createElement(s)
        js.id = id
        js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
        fjs.parentNode.insertBefore(js, fjs)
    })(document, 'script', 'facebook-jssdk')
</script>
<?php require_once("includes/nav.php"); ?>
<div class="container">
    <div class="row">
        <br><br>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Forum</li>
        </ol>
        <br>
        <?php foreach ($results as $categorie) : ?>
            <?php
            $id = $categorie['id'];
            $subCategorieenSql = "SELECT * FROM sub_category WHERE category_id = ?";
            $subCategorieenResult = $dbc->prepare($subCategorieenSql);
            $subCategorieenResult->bindParam(1, $id);
            $subCategorieenResult->execute();
            $results2 = $subCategorieenResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="panel panel-primary ">
                <div class="panel-heading border-colors"><?php echo $categorie['name']; ?></div>
                <div class="panel-body padding-padding">
                    <table>
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>Forum</th>
                                <th>Topics</th>
                                <th>Berichten</th>
                                <th>Laatste bericht</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($results2 as $subCat) : ?>
                            <?php
                                $sql = "SELECT *, COUNT(*) as aantal_topics FROM topic WHERE sub_category_id = ?";
                                $q = $dbc->prepare($sql);
                                $q->bindParam(1, $subCat['id']);
                                $q->execute();
                                $results3 = $q->fetchAll(PDO::FETCH_ASSOC);

                                $query2 = $dbc->prepare('SELECT COUNT(reply.id) as x FROM `sub_category` LEFT JOIN topic ON topic.sub_category_id = sub_category.id LEFT JOIN reply ON reply.topic_id = topic.id WHERE sub_category.id = ?');
                                $query2->bindParam(1, $subCat['id']);
                                $query2->execute();
                                $berichten = $query2->fetchAll(PDO::FETCH_ASSOC)[0];

                                $query3 = $dbc->prepare('SELECT COUNT(topic.id) as x FROM `topic` WHERE sub_category_id = ?');
                                $query3->bindParam(1, $subCat['id']);
                                $query3->execute();
                                $topic_x = $query3->fetchAll(PDO::FETCH_ASSOC)[0];

                            ?>
                            <tr>
                                <td> &#128193;</td>
                                <td>
                                    <a href="topics.php?id=<?php echo $subCat['id']; ?>"><?php echo $subCat['name']; ?></a>
                                </td>
                                <td><?php echo $results3[0]['aantal_topics']; ?></td>
                                <td><?php echo $berichten['x'] + $topic_x['x']; ?></td>
                                <?php
                                    $laasteberichtSql = "SELECT topic.id AS topic_id, reply.id AS reply_id, reply.*, user.* FROM sub_category JOIN topic ON topic.sub_category_id = sub_category.id LEFT JOIN reply ON reply.topic_id = topic.id LEFT JOIN user ON reply.user_id = user.id WHERE sub_category.id = ? ORDER BY reply.created_at DESC LIMIT 1";
                                    $laasteberichtResult = $dbc->prepare($laasteberichtSql);
                                    $laasteberichtResult->bindParam(1, $subCat['id']);
                                    $laasteberichtResult->execute();

                                    $laatsteBericht = $laasteberichtResult->fetchAll(PDO::FETCH_ASSOC);

//                                    echo '<pre>';
//                                    print_r($laatsteBericht);

                                    if (isset($laatsteBericht[0]['reply_id'])): ?>
                                        <td>reply gevonden</td>
                                    <?php elseif(isset($laatsteBericht[0]['topic_id'])): ?>
                                        <td>Topic gevonden</td>
                                    <?php else: ?>
                                        <td>Niks gevonden</td>
                                <?php endif; ?>

                                <?php
//                                if (isset($laatsteBericht[0])): ?>
<!--                                    <td>--><?php //echo $laatsteBericht[0]['created_at']; ?><!--, <br> Door <a href="#">--><?php //echo $laatsteBericht[0]['first_name'].' '.$laatsteBericht[0]['last_name']; ?><!--</a></td>-->
<!--                                --><?php //else: ?>
<!--                                    <td>Er zijn nog geen topics toegevoegd, bent u de eerste?</td>-->
<!--                                --><?php //endif; ?>
                                ?>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="col-md-12 col-sm-12 text-center">
        <img src="http://via.placeholder.com/400x100" alt="">
    </div>
</div>

<footer>
    <?php require 'footer.php'; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
