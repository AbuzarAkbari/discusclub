<?php
    $levels = ["lid", "gebruiker"];
    require_once("../../includes/tools/security.php");

    if(isset($_POST['add_new_category']) && !empty($_POST['new_category']))
    {
        $sql = "INSERT INTO category (name, created_at) VALUES (:name, NOW())";
        $query = $dbc->prepare($sql);
        $query->execute([":name" => $_POST["new_category"]]);
    }

    if(isset($_POST['add_new_sub_category']) && !empty($_POST['new_sub_category']))
    {
        $sql = "INSERT INTO sub_category (category_id, name, created_at) VALUES (:category_id, :name, NOW())";
        $query = $dbc->prepare($sql);
        $query->execute([":category_id" => $_POST['cat_id'], ":name" => $_POST["new_sub_category"]]);
    }

    $categorieenSql = "SELECT * FROM category WHERE deleted_at IS NULL";
    $categorieenResult = $dbc->prepare($categorieenSql);
    $categorieenResult->execute();
    $results = $categorieenResult->fetchAll(PDO::FETCH_ASSOC);
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
        <div class="panel panel-primary">
            <div class="panel-heading border-colors">
                <h3 class="panel-title">Zoek op forum</h3>
            </div>
            <div class="panel-body">
                <form method="get" action="/forum/search">
                    <input type="text" class="form-control" name="q" placeholder='Zoek op het forum..' maxlength="155" required ><br>
                    <button type="submit" class="form-control btn btn-primary">Zoek op forum</button>
                </form>
            </div>
        </div>
        <?php if(in_array($current_level, $admin_levels)) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">Voeg een nieuwe categorie toe</div>
                <div class="panel-body">
                    <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
                        <input style="width: 75%; float: left;" type="text" class="form-control" placeholder="Vul hier de nieuwe categorienaam in.." name="new_category" minlength="3" maxlength="85" required>
                        <input style="width: 20%; float: left; margin-left: 3%;" type="submit" class="col-md-3 btn btn-primary" name="add_new_category" value="Toevoegen">
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php foreach ($results as $categorie) : ?>
            <?php
                $id = $categorie['id'];
                $subCategorieenSql = "SELECT * FROM sub_category WHERE category_id = ? AND deleted_at IS NULL";
                $subCategorieenResult = $dbc->prepare($subCategorieenSql);
                $subCategorieenResult->bindParam(1, $id);
                $subCategorieenResult->execute();
                $results2 = $subCategorieenResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading border-colors">
                    <?php echo $categorie['name']; ?>
                    <?php if(in_array($current_level, $admin_levels)) : ?>
                        <td>
                            <a title="Delete" href="/includes/tools/category/del.php?id=<?php echo $categorie['id']; ?>" class="buttonDelete btn-primary" name="button" style="background-color: #0ba8ec;"> <i class="glyphicon glyphicon-remove-sign"></i></a>
                        </td>
                    <?php endif; ?>
                </div>
                <div class="panel-body padding-padding table-responsive">
                    <form class="row" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST">
                        <br>
                            <div class="col-md-12">
                                <input type="hidden" name="cat_id" value="<?php echo $categorie['id']; ?>">
                                <input style="width: 75%; float: left;" type="text" class="form-control" placeholder="Vul hier de nieuwe subcategorienaam in.." name="new_sub_category" minlength="3" maxlength="83" required>
                                <input style="width: 20%; float: left; margin-left: 3%; margin-bottom: 1%;" type="submit" value="Toevoegen" name="add_new_sub_category" class="form-control btn btn-primary" required>
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
                                <?php if(in_array($current_level, $admin_levels)) : ?>
                                    <th>Admin tools</th>
                                <?php endif; ?>
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
                                    <?php if(in_array($current_level, $admin_levels)) : ?>
                                        <td>
                                            <a title="Delete" href="/includes/tools/sub-category/del.php?id=<?php echo $categorie['id']; ?>&sub_id=<?php echo $subCat['id']; ?>" type="button" class="btn btn-primary " name="button"><i class="glyphicon glyphicon-remove-sign"></i></a>
                                        </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

    <?php require ('../../includes/components/advertentie.php'); ?>
<?php endforeach; ?>
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
