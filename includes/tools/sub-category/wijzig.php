<?php
require_once("../../tools/security.php");

$sql = 'SELECT *, sub_category.name, role.name AS role_name FROM sub_category LEFT JOIN sub_category_permission AS scp ON scp.sub_category_id = sub_category.id LEFT JOIN role ON role.id = scp.role_id WHERE sub_category.id = :id';
$query = $dbc->prepare($sql);
$query->execute([":id" => $_GET['sub_id']]);
$categorie = $query->fetchAll(PDO::FETCH_ASSOC);

$sth = $dbc->prepare("SELECT * FROM role");
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

 <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Wijzig permissie van: <?php echo isset($categorie[0]) ? $categorie[0]['name'] : "niet gevonden"; ?></h4>
  </div>
  <div class="modal-body">
    <form method="POST" action="/forum/index.php">
        <?php foreach($res as $perm) : ?>
            <?php
                $in = array_filter($categorie, function($x) use($perm) {
                  return $x["role_id"] == $perm["id"];
                });
                if(sizeof($in) > 0) {
                  $in = true;
                } else {
                  $in = false;
                }
            ?>
            <input class="form-check-input" name="role[]" value="<?php echo $perm["id"] ?>" id="<?php echo $perm["name"] ?>" <?php echo $in ? "checked=\"checked\"" : null ?> type="checkbox">
            <label class="form-check-label" for="<?php echo $perm["name"] ?>"><?php echo ucfirst($perm["name"]) ?></label><br><br>
            <input type="hidden" name="sub_id" value="<?php echo $_GET["sub_id"]; ?>">
        <?php endforeach; ?>
    	<input class="pull-right btn btn-primary" type="submit" name="bevestig_sub_category" value="Bevestig"><br>
    </form>
  </div>
</div>
