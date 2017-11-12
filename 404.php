<?php require_once("includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("/includes/components/head.php"); ?>
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
        require_once("includes/components/nav.php");

        $result = $dbc->prepare("SELECT * FROM `topic` JOIN sub_category ON category_id JOIN user ON user_id WHERE state_id = 3");
        $result->execute();
        $text = $result->fetch(PDO::FETCH_ASSOC);
      ?>
    <div class="container main">
        <div class="row">
            <br><br>
            <div class="message error">Deze pagina bestaat niet!</div>
        </div>
    </div>
    <footer>
        <?php require 'includes/components/footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
