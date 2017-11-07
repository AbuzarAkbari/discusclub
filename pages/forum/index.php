<?php
    $levels = ["lid", "gebruiker"];
    require_once("../../includes/tools/security.php");

    $categorieenSql = "SELECT * FROM category";
    $categorieenResult = $dbc->prepare($categorieenSql);
    $categorieenResult->execute();
    $results = $categorieenResult->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['add_new_category']))
    {
        $sql = "INSERT INTO category (name) VALUES (:name)";
        $query = $dbc->prepare($sql);
        $query->execute([":name" => $_POST["new_category"]]);
    }
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
<?php require_once("../../includes/components/nav.php"); ?>
<div class="container main">
    <div class="row">
        <br><br>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Forum</li>
        </ol>
        <br>
        <?php if(in_array($current_level, $admin_levels)) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">Voeg een nieuwe categorie toe</div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <label for="new_category">Nieuwe categorie naam</label>
                        <input type="text" class="form-control" name="new_category">
                        <br>
                        <input type="submit" class="form-control btn btn-primary" name="add_new_category" value="Voeg toe">
                    </form>
                </div>
            </div>
        <?php endif; ?>
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
                <div class="panel-body padding-padding table-responsive">
                    <form action="">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="form-control btn btn-primary">
                            </div>
                        </div>
                    </form>
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
                                $sql = "SELECT *, COUNT(*) as aantal_topics FROM topic WHERE sub_category_id = ? AND deleted_at IS NULL";
                                $q = $dbc->prepare($sql);
                                $q->bindParam(1, $subCat['id']);
                                $q->execute();
                                $results3 = $q->fetchAll(PDO::FETCH_ASSOC);

                                $query2 = $dbc->prepare('SELECT COUNT(reply.id) as x FROM sub_category LEFT JOIN topic ON topic.sub_category_id = sub_category.id LEFT JOIN reply ON reply.topic_id = topic.id WHERE sub_category.id = ? AND reply.deleted_at IS NULL AND topic.deleted_at IS NULL');
                                $query2->bindParam(1, $subCat['id']);
                                $query2->execute();
                                $berichten = $query2->fetchAll(PDO::FETCH_ASSOC)[0];

                                $query3 = $dbc->prepare('SELECT COUNT(topic.id) as x FROM `topic` WHERE sub_category_id = ? AND deleted_at IS NULL');
                                $query3->bindParam(1, $subCat['id']);
                                $query3->execute();
                                $topic_x = $query3->fetchAll(PDO::FETCH_ASSOC)[0];
                            ?>
                            <tr>
                                <td> &#128193;</td>
                                <td>
                                    <a href="/forum/topic/<?php echo $subCat['id']; ?>"><?php echo $subCat['name']; ?></a>
                                </td>
                                <td><?php echo $results3[0]['aantal_topics']; ?></td>
                                <td><?php echo $berichten['x'] + $topic_x['x']; ?></td>
                                <?php
                                    $laasteberichtSql = "SELECT *, r.last_changed AS reply_last_changed, t.last_changed AS topic_last_changed, r.user_id AS reply_user_id, t.user_id AS topic_user_id, u.first_name AS reply_first_name, u.last_name AS reply_last_name, u2.first_name AS topic_first_name, u2.last_name AS topic_last_name FROM topic AS t LEFT JOIN reply AS r ON r.topic_id = t.id LEFT JOIN user AS u ON u.id = r.user_id LEFT JOIN user AS u2 ON u2.id = t.user_id WHERE t.sub_category_id = :sub_id AND t.deleted_at IS NULL ORDER BY r.last_changed DESC, t.last_changed DESC LIMIT 1";
                                    $laasteberichtResult = $dbc->prepare($laasteberichtSql);
                                    $laasteberichtResult->execute([":sub_id" => $subCat["id"]]);

                                    $laatsteBericht = $laasteberichtResult->fetch(PDO::FETCH_ASSOC);

                                if ($laatsteBericht) : ?>
                                        <td>
                                            <?php echo isset($laatsteBericht["reply_last_changed"]) ? $laatsteBericht["reply_last_changed"] : $laatsteBericht["topic_last_changed"]; ?>,
                                            <br>Door <a href="/user/<?php echo isset($laatsteBericht["reply_user_id"]) ? $laatsteBericht["reply_user_id"] : $laatsteBericht["topic_user_id"]; ?>">
                                                <?php echo isset($laatsteBericht["reply_first_name"]) ? $laatsteBericht["reply_first_name"] . " " . $laatsteBericht["reply_last_name"] : $laatsteBericht["topic_first_name"] . " " . $laatsteBericht["topic_last_name"] ?>
                                            </a>
                                        </td>
                                    <?php else : ?>
                                        <td>Niks gevonden</td>
                                <?php endif; ?>

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
    <?php require_once("../../includes/components/footer.php"); ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
