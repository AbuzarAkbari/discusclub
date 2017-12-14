<?php
try {
    $dbc = new PDO("mysql:host=127.0.0.1;dbname=tmp", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sth = $dbc->prepare("SELECT email FROM user");
$sth->execute();

$res = $sth->fetchAll(PDO::FETCH_OBJ);

$file = fopen(__DIR__ . "/mail.csv", "w");
$txt = "";
foreach ($res as $key => $value) {
    $txt .= $value->email . "\r\n";
}
fwrite($file, $txt);

fclose($file);