<?php
$levels = [];
require_once("security.php");

$sql = "UPDATE ip
        SET blocked = :blocked
        WHERE ip_address = :ip";

// UPDATE `ip` SET `id`= 1 , `blocked`= 1 WHERE id = 1
$result = $dbc->prepare($sql);
$result->execute([":blocked" => $_GET["blocked"],":ip" => $_GET['ip']]);

header('Location: /admin/ip-list');


//address = :adres, house_number = :huisnummer, postal_code = :postcode, city = :stad, phone = :telefoonnummer, iban = :rekeningnummer
// ":adres" => $adres , ":huisnummer" => $huisnummer, ":postcode" => $postcode ,":stad" => $stad,":telefoonnummer" => $telefoonnummer, ":rekeningnummer" => $rekeningnummer, ":id" => $_SESSION['user']->id]);
