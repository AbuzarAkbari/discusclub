<?php
$levels = [];
require_once("../security.php");

if($_GET["id"]) {
    $sth = $dbc->prepare("UPDATE user SET deleted_at = NOW() WHERE id = :id");
    $sth->execute([":id" => $_GET["id"]]);
}