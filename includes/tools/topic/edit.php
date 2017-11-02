<?php
$levels = [];
require_once("../../../includes/tools/security.php");

$sql = "SELECT * FROM topic WHERE id = :id";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["id"]]);
$topics = $result->fetchAll(PDO::FETCH_ASSOC);



print_r($topics);
exit();

header("Location: ../../../forum/");
