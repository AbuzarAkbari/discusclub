<?php
    if (isset($_POST['send'])) {
        mail("shadew69@gmail.com","Reactie van DiscusClubHolland",$_POST['bericht']);

        header('Location: http://hierkomteensite.com/');
    }
?>
