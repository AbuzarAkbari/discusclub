<?php
    if (isset($_POST['send'])) {
        $date = $_POST['birthdate'];

        if ($date === FALSE) {
            echo "<div class='message error'>De ingevoerde geboortedatum klopt niet</div>";
        }
    }
