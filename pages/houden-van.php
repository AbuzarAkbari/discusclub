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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
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
    <div class="row">
        <h1><?php echo $page['name']; ?></h1>
        <hr class="col-md-12">
        <div class="col-md-6">
            <?php echo $page['content']; ?>
        </div>
        <div class="col-md-6">
            <img src="/images/<?php echo $page['path']; ?>" alt="">
        </div>
    </div>
    <br>
</div>
<footer>
    <?php require_once('../includes/components/footer.php') ; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
