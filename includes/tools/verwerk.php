<?php
if (isset($_POST['send'])) {

    // the message
    $msg = htmlentities($_POST['email'])  . "\r\n" . htmlentities($_POST['bericht']);

    $msg = wordwrap($msg, 70, "\r\n");

    $headers =  'From: ' . $_POST['email'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // send email
    mail("shadew69@gmail.com","Bericht van " . htmlentities($_POST['naam']), $msg , $headers);

} else {

}

header('Location: /');
