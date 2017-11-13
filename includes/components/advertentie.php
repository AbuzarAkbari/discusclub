<?php
require_once("includes/tools/security.php");

$sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id WHERE approved = 1 ORDER BY RAND() LIMIT 1";
$result = $dbc->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
echo "
<div class='col-md-12 text-center'>
    <img alt='Banner' class='sponsor_vak' src='/images".$rows[0]['path'] . "' alt=''>
    </div>
    ";
