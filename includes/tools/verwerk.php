<?php
if (isset($_POST['send'])) {

    // the message
    $msg = htmlentities($_POST['email'])  . "\r\n" . htmlentities($_POST['bericht']);

    $msg = wordwrap($msg, 70, "\r\n");

    $headers =  'From: ' . $_POST['email'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    // send email
<<<<<<< HEAD
    mail("shadew69@gmail.com","Bericht van " . htmlentities($_POST['naam']), $msg , $headers);
=======
    mail("kaani@live.nl","Bericht " . htmlentities($_POST['naam']), $msg , $headers);
>>>>>>> 24ade0868e4308cb4648e1969ba1e605cc63f355

}

header('Location: /');
