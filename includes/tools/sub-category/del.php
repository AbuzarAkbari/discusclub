<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "UPDATE sub_category SET deleted_at = NOW() WHERE id = :sub_id";
$result = $dbc->prepare($sql);
$result->execute([":sub_id" => $_GET["sub_id"]]);

header("Location: ../../../forum/");
