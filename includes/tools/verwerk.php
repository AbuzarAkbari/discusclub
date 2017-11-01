<?php
if (isset($_POST['send'])) {

    // the message
    $msg = $_POST['email']  . "\r\n" . $_POST['bericht'];

    $msg = wordwrap($msg, 70, "\r\n");

    $headers =  'From: example@example.nl' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // send email
    mail("kaani@live.nl","Bericht van " . $_POST['naam'], $msg , $headers);

    header('Location: /');
}
