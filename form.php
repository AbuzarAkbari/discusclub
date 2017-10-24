<?php require_once('dbc.php');
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
<div class="header">
    <div class="container">
        <div class="inlog">
            <a href="inloggen.php">Inloggen</a>
            <a href="registeren.php">Registreer</a>
            <a href="wachtwoordvergeten.php">Wachtwoord vergeten?</a>
        </div>
        <div class="col-xs-6">
            <img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland">
        </div>
    </div>
</div>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
        </div>
        <?php require 'nav_uitloggen.php'; ?>
        <!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="row">
        <br><br>
        <?php foreach($results as $categorie) : ?>
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
                        <?php foreach($results2 as $subCat): ?>
                            <?php
                                $sql = "SELECT *, COUNT(*) as aantal_topics FROM topic WHERE sub_category_id = ?";
                                $q = $dbc->prepare($sql);
                                $q->bindParam(1, $subCat['id']);
                                $q->execute();
                                $results3 = $q->fetchAll(PDO::FETCH_ASSOC);

//                                $sql2 = "SELECT COUNT(id) AS i FROM reply WHERE topic_id = ?";
//                                $q2 = $dbc->prepare($sql2);
//                                $q2->bindParam(1, $subCat['id']);
//                                $q2->execute();
//                                $results4 = $q2->fetchAll(PDO::FETCH_ASSOC);

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
                                <td>1 dag geleden, <br> Door <a href="#"><?php echo 'John Doe'; ?></a></td>
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
