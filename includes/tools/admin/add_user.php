<?php
$levels = [];
require_once("../security.php");

if($_GET["id"]) {
    $sth = $dbc->prepare("UPDATE user SET deleted_at = NULL WHERE id = :id");
    $sth->execute([":id" => $_GET["id"]]);
}

header("Location: " . $_SERVER["HTTP_REFERER"]);