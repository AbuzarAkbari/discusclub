<?php

$levels = [];
require_once("../security.php");

$sql = "UPDATE user SET role_id = :new WHERE id = :id";
$sth = $dbc->prepare($sql);
$sth->execute([":id" => $_GET["id"], ":new" => $_GET["new"]]);

header("Location: /admin/approval-signup");
