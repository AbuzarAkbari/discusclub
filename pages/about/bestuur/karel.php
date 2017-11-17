<?php require_once("../../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../../includes/components/head.php"); ?>
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
    require_once("../../../includes/components/nav.php");
    ?>

    <br><br>
    <div class="container main">
      <div class="row columns">
          <div class="col-md-12">
              <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/about/">Over ons</a></li>
                  <li><a href="/about/bestuur">Het bestuur</a></li>
                  <li class="active">NAAM LID</li>
              </ol>
          </div>
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">NAAM LID</div>
          <div class="panel-body padding-padding space">
           <!-- start slipsum code -->

            <h3>I'm serious as a heart attack</h3>
            <p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb. </p>

            <h3>Are you ready for the truth?</h3>
            <p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb. </p>

            <h3>Hold on to your butts</h3>
            <p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they're actually proud of that shit.  </p>

            <h3>I can do that</h3>
            <p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they're actually proud of that shit.  </p>

            <h3>We happy?</h3>
            <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass. </p>

            <!-- end slipsum code -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      </div>
      <div class="col-md-8"></div>
      <div class="col-md-8"></div>
    </div>
  </div>
    <?php require '../../../includes/components/advertentie.php'; ?>
    <footer>
<?php require_once("../../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>