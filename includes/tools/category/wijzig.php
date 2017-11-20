 <?php
 require_once("../../tools/security.php");

 $sql = 'SELECT * FROM category WHERE id = :id';
 $query = $dbc->prepare($sql);
 $query->execute([":id" => $_GET['id']]);
 $categorie = $query->fetch(PDO::FETCH_ASSOC);
 ?>

 <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Wijzig permissie van: <?php echo $categorie['name']?></h4>
  </div>
  <div class="modal-body">
    <form method="POST" action="/forum/index.php">
	    <label for="gebruiker">Gebruiker</label> <input name="gebruiker" id="gebruiker" type="checkbox"> 
    	<label for="lid">Lid</label><input name="lid" id="lid" type="checkbox"> 
    	<label for="redacteur">Redacteur</label><input name="redacteur" id="redacteur" type="checkbox"> 
    	<label for="admin">Admin</label><input name="admin" id="admin" type="checkbox"> 
    	<input class="pull-right" type="submit" name="bevestig" value="Bevestig">
    </form>
  </div>
</div>