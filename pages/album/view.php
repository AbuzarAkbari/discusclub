<?php
$levels = ["gast", "lid", "gebruiker"];
require_once("../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- Slider  -->
        <!-- Add the slick-theme.css if you want default styling -->
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">
    <link rel="stylesheet" href="/css/view.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <?php require_once("../../includes/components/nav.php"); ?>

    <br><br>
    <div class="container main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Album titel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <div class="row sliderbox">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <!-- <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active">
                                            <img src="/images/vissen3.jpg" alt="vissen">

                                        </li>
                                        <li data-target="#myCarousel" data-slide-to="1">
                                            <img src="/images/vissen3.jpg" alt="vissen">

                                        </li>
                                        <li data-target="#myCarousel" data-slide-to="2">
                                            <img src="/images/vissen3.jpg" alt="vissen">

                                        </li>
                                    </ol> -->

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="http://via.placeholder.com/350x150" alt="fishing">
                                        </div>

                                        <div class="item">
                                            <img src="http://via.placeholder.com/350x151" alt="fishing">
                                        </div>

                                        <div class="item">
                                            <img src="http://via.placeholder.com/350x152" alt="vissen">
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"> </span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"> </span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <!-- images -->

                            </div>
                        </div>
                        <div id="scrollable">
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x150')"; data-target="#myCarousel" data-slide-to="0"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x151')"; data-target="#myCarousel" data-slide-to="1"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                            <div class=" img" style="background-image:url('http://via.placeholder.com/350x152')"; data-target="#myCarousel" data-slide-to="2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
  <br>
  <br>
  <br>
    <footer>
    <?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- scrollable  -->
    <script src="/js/view.js">scrollable.addEventListener('mousemove', event => {
        console.log(event)
    })
</script>

    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- slider -->
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
</body>
</html>
