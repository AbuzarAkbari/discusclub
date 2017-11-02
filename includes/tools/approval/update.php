<?php
if(isset($_GET['button'])){
    $sql = "UPDATE sponsor SET approved = :new WHERE id = :id";
    $sth = $dbc->prepare($sql);
    $sth->execute([":id" => $_GET["id"], ":new" => $_GET["new"]]);
}
header("Location: /admin/approval_sponsor");
