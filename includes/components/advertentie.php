<?php

$sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id WHERE approved = 1 ORDER BY RAND() LIMIT 1";
$result = $dbc->prepare($sql);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
if(!isset($ad_in_row)) {
    $ad_in_row = false;
}
?>
<script>
// mijn gefaalde pogin (abuzar)

    // var x = Math.floor((Math.random() * 2) + 1);
    // var discusAd = "1"
    // var adsense = "<ins class='adsbygoogle'
    //              style='display:block'
    //              data-ad-client='ca-pub-3271020881230164'
    //              data-ad-slot='6824529582'
    //              data-ad-format='auto'></ins>"
    // if (x = 1){
    //     discusAd
    // }else if (x = 2) {
    //     adsense
    // } else {
    //     "niks"
    // }
</script>
<div class='<?php echo $ad_in_row ? "col-md-12" : null; ?>text-center'>
    <a target="_blank" href="<?php echo $rows[0]['url'];?>">
        <img alt='Banner' class='sponsor_vak' src='/images<?php echo $rows[0]['path']; ?>' alt=''>
    </a>
</div>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-3271020881230164"
     data-ad-slot="6824529582"
     data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
