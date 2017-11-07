<?php require_once("../../includes/tools/security.php"); ?>
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
        require_once("../../includes/components/nav.php");
      ?>
    <div class="container main">
        <br>
        <div class="row">
            <h1>Iets over vissen ofzo!</h1>
            <hr class="col-md-12">
            <div class="col-md-6">
                You think water moves fast? You should see ice. It moves like it has a mind.
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.<br><br>
                Like it knows it killed the world once and got a taste for murder. After the avalanche,
                it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                but I know that seven of us survived the slide... and only five made it out. Now we took an oath,
                that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.
                Nature is lethal but it doesn't hold a candle to man.
            </div>
            <div class="col-md-6">
                <img src="/images/vis(1).jpg" alt="">
            </div>
        </div>
        <br>
    </div>
    <footer>
        <?php require_once('../../includes/components/footer.php') ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
