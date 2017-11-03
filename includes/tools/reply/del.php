<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "UPDATE reply SET deleted_at = NOW() WHERE id = :id";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["id"]]);

header("Location: /forum/");
