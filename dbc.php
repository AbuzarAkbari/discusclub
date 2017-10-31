<?php

    try {
        $dbc = new PDO("mysql:host=127.0.0.1;dbname=forum", "root", "");
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
