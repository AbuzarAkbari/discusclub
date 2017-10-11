<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div id="fb-root"></div>
    <script>
    ;(function(d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0]
  if (d.getElementById(id)) return
  js = d.createElement(s)
  js.id = id
  js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
  fjs.parentNode.insertBefore(js, fjs)
})(document, 'script', 'facebook-jssdk')
</script>
    <div class="header">
      <div class="inlog">
          <a href="inloggen.php">Inloggen</a>
          <a href="registeren.php">Registreer</a>
          <a href="wachtwoordvergeten.php">Wachtwoord vergeten?</a>
      </div>
        <div class="col-xs-6">
            <img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland">
        </div>
    </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>
            </div>
            <div id='navbar' class='navbar-collapse collapse'>
                <ul class='nav navbar-nav'>
                    <li><a href='index.php'>Home</a></li>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Over ons <span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                            <li><a href='ontstaan.php'>Onstaan Discus Club Holland</a></li>
                            <li><a href='nieuws.php'>Nieuws</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Forum <span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                            <li><a href='actievetopics.php'>Actieve topics</a></li>
                            <li><a href='nieuwetopics.php'>Nieuw topics</a></li>
                            <li><a href='#.php'>Favoriete topics</a></li>
                            <li><a href='#.php'>Ledenlijst</a></li>
                        </ul>
                    </li>
                    <li><a href='wordlid.php'>Word lid!</a></li>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Sponsoren <span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                            <li><a href='sponsoren-worden.php'>Ook sponsor worden?</a></li>
                            <li><a href='sponsoren.php'>Onze sponsoren</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Albums <span class='caret'></span></a>
                        <ul class='dropdown-menu'>
                            <li><a href='#.php'>Upload</a></li>
                        </ul>
                    </li>
                      <li class="navbar-right"><a href="#">Gebruiker</a></li>
                      <li class="navbar-right"><a href="#">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row sliderbox">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/vissen1.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen2.jpg" alt="fishing">
                    </div>

                    <div class="item">
                        <img src="images/vissen3.jpg" alt="vissen">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <br><br>
            <div class="col-md-12">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                <br><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit
                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                <br><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                <br><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit
                amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                <br><br>
            </div>
        </div>
        <br><br>
    </div>
    <div class="row ">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Reacties</div>
                <div class="panel-body">
                    <div class="box">
                        <p class="title-box title-box-color"><b>Lorem slipsum</b></p>
                        <div class="col-md-3">
                            <img src="http://via.placeholder.com/75x75">
                        </div>
                        <div class="col-md-9">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            <hr>
                        </div>
                    </div>
                    <br><br>
                    <div class="box">
                        <p class="title-box title-box-color"><b>lorem slipslum</b></p>
                        <div class="col-md-3">
                            <img src="http://via.placeholder.com/75x75">
                        </div>
                        <div class="col-md-9">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                            laborum.
                            <hr>
                        </div>
                    </div>
                    <br><br>
                    <div class="box">
                        <p class="title-box title-box-color"><b>Lorem slipsum</b></p>
                        <div class="col-md-3">
                            <img src="http://via.placeholder.com/75x75">
                        </div>
                        <div class="col-md-9">
                            Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded.
                            That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.
                            <hr>
                        </div>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="nieuws-box">
                    <div class="panel-heading">Ander nieuws</div>
                    <div class="panel-body">
                        <p><b>lorem slipsum</b></p>
                        You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other,
                        but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't
                        hold a candle to man.
                        <br><br>
                        <button class="lees-meer-btn" type="button" name="button">Lees meer</button>
                        <br><br>
                        <p><b>lorem slipsum</b></p>
                        Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've
                        known way back when... You know why, David? Because of the kids. They called me Mr Glass.
                        <br><br> The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness,
                        for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name
                        is the Lord when I lay My vengeance upon thee.
                        <br><br>
                        <button class="lees-meer-btn" type="button" name="button">Lees meer</button>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <div class="footer-wrapper">
            <div class="col-md-4 text-center">
                <h3 class="footer-title"><b>Vind ons leuk!</b></h3>
                <div class="fb-page" data-href="https://www.facebook.com/DiscusClubHolland/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/DiscusClubHolland/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <h3 class="footer-title"><b>Volg ons op Twitter!</b></h3>
                <a class="twitter-timeline"  href="https://twitter.com/discusholland?lang=en"  data-widget-id="831416744602431488">Tweets van @HealthBetuwe</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
            <div class="col-md-4 col-sm-12 text-center">
                <h3 class="footer-title"><b>Contact</b></h3>
                <form class="" action="verwerk.php" method="post">
                    <input class="footer-name" type="text" name="naam" value="" placeholder="Naam"><br>
                    <textarea class="footer-message" name="bericht" placeholder="Uw bericht"></textarea><br>
                    <input class="lees-meer-btn footer-btn" type="submit" name="send" value="Verzenden">
                </form>
            </div>
            <div class="col-md-12 text-center">
                <a href="#">&copy; Discus Club Holland</a> | <a href="#">Webdesign door Impact4ROI</a> | <a href="#">Algemene voorwaarden</a>
            </div>
        </div>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
