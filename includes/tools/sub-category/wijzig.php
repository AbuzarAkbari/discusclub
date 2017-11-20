<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "";
$result = $dbc->prepare($sql);
$result->execute([":sub_id" => $_GET["sub_id"]]);

header("Location: ../../../forum/");
