<?php
$levels = [];
require_once("security.php");

$sql = "UPDATE ip
        SET blocked = :blocked
        WHERE ip_address = :ip";

$result = $dbc->prepare($sql);
$result->execute([":blocked" => $_GET["blocked"],":ip" => $_GET['ip']]);

header('Location: /admin/ip-list');
