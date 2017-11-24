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
    $msg = htmlentities($_SESSION['user']->email)  . "\r\n" . htmlentities($_SESSION['user']->first_name . " " . $_SESSION['user']->last_name . ", \r\n heeft zich aangemeld als lid. \r\n klik op deze link om het te zien: <a href='https://discus.ricardokamerman.com/admin/approval-signup/'>https://discus.ricardokamerman.com/admin/approval-signup/</a>");

    $msg = wordwrap($msg, 70, "\r\n");

    $headers =  'From: ' . $_SESSION['user']->email . "\r\n" .
                'Content-Type: text/html; charset=utf-8 '. "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // send email
    mail("redactie@discusclubholland.nl","Bericht van " . htmlentities($_SESSION['user']->first_name . " " . $_SESSION['user']->last_name), $msg , $headers);
}

header('Location: /wordlid');
