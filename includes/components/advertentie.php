<?php

$sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id WHERE approved = 1 ORDER BY RAND() LIMIT 1";
$result = $dbc->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
if(!isset($ad_in_row)) {
    $ad_in_row = false;
}

if(rand(0, 1)) :
?>
<div class='<?php echo $ad_in_row ? "col-md-12" : null; ?>text-center'>
    <a target="_blank" href="<?php echo $rows[0]['url'];?>">
        <img alt='Banner' class='sponsor_vak' src='/images<?php echo $rows[0]['path']; ?>' alt=''>
    </a>
</div>
<?php else: ?>
    <div style="padding-bottom: 15px;" class="col-md-12">
<ins
    class="adsbygoogle"
     style="display:block; "
     data-ad-client="ca-pub-3271020881230164"
     data-ad-slot="6824529582"
     data-ad-format="auto">
 </ins>
</div>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php endif; ?>
