<?php
$levels = [];
require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../includes/components/head.php"); ?>
</head>

<body>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php
    require_once("../../includes/components/nav.php");
    ?>
    <br><br>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading border-color-blue">Admin tools</div>
                    <div class="panel-body padding-padding space">
                        <li class="overonsHover"><a href="/admin/ip-list">IP Lijst</a></li>
                        <li class="overonsHover"><a href="/admin/contest">Contest</a></li>
                        <li class="overonsHover"><a href="/admin/user-list">Ledenlijst</a></li>
                        <li class="overonsHover"><a href="/admin/approval-signup">Inschrijvingen</a></li>
                        <li class="overonsHover"><a href="/admin/approval-sponsor">Sponsoren</a></li>
                        <li class="overonsHover"><a href="/admin/page">Houden van</a></li>
                    </div>
                </div>
            </div>
      </div>
    </div>
    <footer>
    <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
