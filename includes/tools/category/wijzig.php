 <?php
 require_once("../../tools/security.php");

 $sql = 'SELECT * FROM category WHERE id = :id';
 $query = $dbc->prepare($sql);
 $query->execute([":id" => $_GET['id']]);
 $categorie = $query->fetch(PDO::FETCH_ASSOC);

 //Permissions
 $getPermissionsSql = "SELECT *, role.id as role_id, cp.role_id as perm_role_id FROM category_permission as cp FULL JOIN role ON role.id = cp.role_id WHERE category_id = :id";
 $getPermissionsResult = $dbc->prepare($getPermissionsSql);
 $getPermissionsResult->execute([":id" => $_GET['id']]);
 $getPermissionsResult = $getPermissionsResult->fetchAll(PDO::FETCH_ASSOC);
 ?>

 <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Wijzig permissie van: <?php echo $categorie['name']?></h4>
  </div>
  <div class="modal-body">
    <?php
    echo "<pre>";
    var_dump($getPermissionsResult);
    echo "</pre>";
    ?>
    <form method="POST" action="/forum/index.php">
        <?php foreach($getPermissionsResult as $perm) : ?>
	    <label for="<?php echo $perm["name"] ?>"><?php echo ucfirst($perm["name"]) ?></label> <input name="role[]" value="<?php echo $perm["role_id"] ?>" id="<?php echo $perm["name"] ?>" <?php echo isset($perm["perm_role_id"]) ? "checked=\"checked\"" : null ?> type="checkbox">
        <?php endforeach; ?>
    	<input class="pull-right" type="submit" name="bevestig" value="Bevestig">
    </form>
  </div>
</div>