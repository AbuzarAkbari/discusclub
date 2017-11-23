<?php
    $sql = "SELECT *, sponsor.id FROM sponsor JOIN image ON sponsor.image_id = image.id WHERE approved = 1 ORDER BY RAND() LIMIT 1";
    $result = $dbc->prepare($sql);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if(!isset($ad_in_row)) {
        $ad_in_row = false;
    }

    if(!isset($ad_count)) {
        $ad_count = 0;
    }
?>

<?php if((rand(0, 1) && isset($row)) || ($ad_count >= 3 && isset($row))) : ?>
<div class='<?php echo $ad_in_row ? "col-md-12" : null; ?>text-center'>
    <a target="_blank" href="<?php echo $row['url'];?>">
        <img alt='Banner' class='sponsor_vak' src='/images<?php echo $row['path']; ?>' alt=''>
    </a>
</div>
<?php else : ?>
    <?php $ad_count++; ?>
    <div style="padding-bottom: 15px; " class="col-md-12">

        <ins
            class="adsbygoogle"
             style="display:block; "
             data-ad-client="ca-pub-3271020881230164"
             data-ad-slot="6824529582"
             data-ad-format="auto">
         </ins>

    </div>
    <div class="clearfix"></div>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
<?php endif; ?>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
