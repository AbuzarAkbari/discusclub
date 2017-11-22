<?php
require_once("../../tools/security.php");

$sql = 'SELECT *, news.title, role.name AS role_name FROM news LEFT JOIN news_permission AS np ON np.news_id = news.id LEFT JOIN role ON role.id = np.role_id WHERE news.id = :id';
$query = $dbc->prepare($sql);
$query->execute([":id" => $_GET['id']]);
$news = $query->fetchAll(PDO::FETCH_ASSOC);

$sth = $dbc->prepare("SELECT * FROM role");
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Wijzig permissie van: <?php echo isset($news[0]) ? $news[0]['title'] : "niet gevonden"; ?></h4>
    </div>
    <div class="modal-body">
        <form method="POST" action="/news/index.php">
            <?php foreach($res as $perm) : ?>
            <?php
            $in = array_filter($news, function($x) use($perm) {
                return $x["role_id"] == $perm["id"];
            });
            if(sizeof($in) > 0) {
                $in = true;
            } else {
                $in = false;
            }
            ?>
            <?php echo ucfirst($perm["name"]) ?></label> <input class="form-check-input" name="role[]" value="<?php echo $perm["id"] ?>" <?php echo $in ? "checked=\"checked\"" : null ?> type="checkbox"><label class="form-check-label" for="<?php echo $perm["name"] ?>"><br>
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <?php endforeach; ?>
                <input class="pull-right btn btn-primary" type="submit" name="bevestig" value="Bevestig">
        </form>
    </div>
</div>
