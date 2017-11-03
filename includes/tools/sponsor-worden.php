<?php
require_once("security.php");
if(isset($_POST['send'])) {
    $bedrijf = ucfirst($_POST['bedrijf']);
    $afbeelding = $_POST['afbeelding'];
    $url = $_POST['url'];
    $opties = $_POST['opties'];

    $afbeelding = str_replace(' ', '', $afbeelding);

    $sth = $dbc->prepare("INSERT INTO image(path) VALUES (:afbeelding)");
    $sth->execute([":afbeelding" => ubnjof]);
    $image_id = $dbc->lastInsertId();

    $sth = $dbc->prepare("INSERT INTO sponsor(image_id, name, url,) VALUES (:afbeelding, :bedrijf, :url, :opties)");
    $sth->execute([":afbeelding" => $afbeelding, ":bedrijf" => $bedrijf, ":url" => $url, ":opties" => $opties]);
}

header('Location: /sponsor/become');
