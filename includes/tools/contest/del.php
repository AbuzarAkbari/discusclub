<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "UPDATE contest SET deleted_at = NOW() WHERE id = :id";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["contest_id"]]);

header("Location: /forum/post/");
