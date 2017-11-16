<?php

$levels = [];
require_once("../security.php");

$sql = "UPDATE user SET role_id = :new WHERE id = :id";
$sth = $dbc->prepare($sql);
$sth->execute([":id" => $_GET["id"], ":new" => $_GET["new"]]);
$sql = "UPDATE approval_signup SET approved = :new WHERE user_id = :id";
$sth = $dbc->prepare($sql);
$sth->execute([":id" => $_GET["id"], ":new" => $_GET["new"] == 2 ? 2 : 1]);
header("Location: /admin/approval-signup");
