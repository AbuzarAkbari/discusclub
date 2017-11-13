<?php

$sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id WHERE approved = 1 ORDER BY RAND() LIMIT 1";
$result = $dbc->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
if(!isset($ad_in_row)) {
    $ad_in_row = false;
}
?>
<div class='<?php echo $ad_in_row ? "col-md-12" : null; ?>text-center'>
    <a target="_blank" href="<?php echo $rows[0]['url'];?>">
        <img alt='Banner' class='sponsor_vak' src='/images<?php echo $rows[0]['path']; ?>' alt=''>
    </a>
</div>
