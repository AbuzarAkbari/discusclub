<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["id"]]);

header("Location: ../../../forum/");
