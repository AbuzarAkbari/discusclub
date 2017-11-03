<?php
require_once("security.php");
if(isset($_POST['send'])) {
    $adres = $_POST['adres'];
    $huisnummer = $_POST['huisnummer'];
    $postcode = strtoupper($_POST['postcode']);
    $stad = $_POST['stad'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $rekeningnummer = $_POST['rekeningnummer'];

    $postcode = str_replace(' ', '', $postcode);

    $sql = "UPDATE user
            SET address = :adres, house_number = :huisnummer, postal_code = :postcode, city = :stad, phone = :telefoonnummer, iban = :rekeningnummer
            WHERE id = :id";

    $result = $dbc->prepare($sql);
    $result->execute([":adres" => $adres , ":huisnummer" => $huisnummer, ":postcode" => $postcode ,":stad" => $stad, ":telefoonnummer" => $telefoonnummer, ":rekeningnummer" => $rekeningnummer, ":id" => $_SESSION['user']->id]);
}

header('Location: /wordlid');