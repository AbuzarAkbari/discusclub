<?php

// try {
//     $dbc = new PDO("mysql:host=127.0.0.1;dbname=discus", "discus", "R2mje6_G9lTlwhur", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
//     // $dbc = new PDO("mysql:host=127.0.0.1;dbname=forum", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
//     $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
try {
    // $dbc = new PDO("mysql:host=127.0.0.1;dbname=discus", "discus", "R2mje6_G9lTlwhur", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbc = new PDO("mysql:host=127.0.0.1;dbname=forum", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
