<?php
require_once("security.php");
if(isset($_POST['send'])) {
    $adres = rmScript(htmlentities($_POST['adres']));
    $huisnummer = rmScript(htmlentities($_POST['huisnummer']));
    $postcode = rmScript(htmlentities(strtoupper($_POST['postcode'])));
    $stad = rmScript(htmlentities($_POST['stad']));
    $telefoonnummer = rmScript(htmlentities($_POST['telefoonnummer']));
    $rekeningnummer = rmScript(htmlspecialchars($_POST['rekeningnummer']));

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

    //Send email to redactie
    ob_start();
    require_once("mailtemplate_lid.php");
    $message = ob_get_clean();

    $message = wordwrap($message, 70, "\r\n");

    $headers =  'From: ' . $_SESSION['user']->email . "\r\n" .
        'Content-Type: text/html; charset=utf-8 '. "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail('redactie@discusclubholland.nl', "Nieuw lid", wordwrap($message, 70, "\r\n"), $headers);
}

header('Location: /wordlid');
