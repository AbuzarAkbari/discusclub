<?php
require_once("security.php");
if(isset($_POST['send'])) {
    $adres = htmlentities($_POST['adres']);
    $huisnummer = htmlentities($_POST['huisnummer']);
    $postcode = htmlentities(strtoupper($_POST['postcode']));
    $stad = htmlentities($_POST['stad']);
    $telefoonnummer = htmlentities($_POST['telefoonnummer']);
    $rekeningnummer = htmlspecialchars($_POST['rekeningnummer']);

    $postcode = str_replace(' ', '', $postcode);

    $sql = "UPDATE user
            SET address = :adres, house_number = :huisnummer, postal_code = :postcode, city = :stad, phone = :telefoonnummer, iban = :rekeningnummer
            WHERE id = :id";

    $result = $dbc->prepare($sql);
    $result->execute([":adres" => $adres, ":huisnummer" => $huisnummer, ":postcode" => $postcode,":stad" => $stad, ":telefoonnummer" => $telefoonnummer, ":rekeningnummer" => $rekeningnummer, ":id" => $_SESSION['user']->id]);

    // $sql = "INSERT INTO favorite (user_id, topic_id) VALUES (:user_id, :topic_id)";
    $sql = "INSERT INTO approval_signup(approved, user_id) VALUES (:approved, :user_id)";

    $result = $dbc->prepare($sql);
    $result->execute([":approved" => 0, ":user_id" => $_SESSION['user']->id]);

}

header('Location: /wordlid');
