<?php
if (isset($_POST['send'])) {

    // the message
    $msg = htmlentities($_POST['email'])  . "\r\n" . htmlentities($_POST['bericht']);

    $msg = wordwrap($msg, 70, "\r\n");

    $headers =  'From: ' . $_POST['email'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // send email
    mail("redactie@discusclubholland.nl","Bericht van " . htmlentities($_POST['naam']), $msg , $headers);

}

header('Location: /contact?msg=Uw bericht is succesvol ontvangen en wordt zo spoedig mogelijk behandeld door ons.');
