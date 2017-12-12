<?php
require_once("../includes/tools/security.php");

$sql = "SELECT * FROM page JOIN image ON page.image_id = image.id WHERE uri = :uri";
$result = $dbc->prepare($sql);
$result->execute([":uri" => isset($_GET["uri"]) ? $_GET["uri"] : "houden-van"]);
$page = $result->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../includes/components/head.php"); ?>
</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
<div id="fb-root"></div>
<script>
    ;
    (function(d, s, id) {
        var js,
            fjs = d.getElementsByTagName(s)[0]
        if (d.getElementById(id)) return
        js = d.createElement(s)
        js.id = id
        js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
        fjs.parentNode.insertBefore(js, fjs)
    })(document, 'script', 'facebook-jssdk')
</script>
<?php
require_once("../includes/components/nav.php");
?>
<div class="container main">
    <br>
    <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li class="active"><?php echo $page['name']; ?></li>
                </ol>
            </div>
    <div class="row">
        <h1><?php echo $page['name']; ?></h1>
        <hr class="col-md-12">
        <div class="col-md-6">
            <?php echo $page['content']; ?>
        </div>
        <div class="col-md-6">
            <img src="/images<?php echo $page['path']; ?>">
        </div><br><br>
        <?php if ($logged_in && $page) : ?>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Antwoord toevoegen</h3>
                    </div>
                    <div class="panel-body">
                        <div class="fb-comments" data-href="https://www.facebook.com/DiscusClubHolland/" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <br>
    <?php
    // $ad_in_row = true;
    require_once('../includes/components/advertentie.php'); ?>
</div>
<footer>
    <?php require_once('../includes/components/footer.php') ; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
