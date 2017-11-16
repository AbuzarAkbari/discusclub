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
                  <li class="active">Jan Verkaik</li>
              </ol>
          </div>
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Jan Verkaik</div>
          <div class="panel-body padding-padding space">
                <h4>Image with align="left":</h4>
              <p>This is some text. <img src="images/bestuur/jan.PNG" width="42" height="42" align="left"> This is some text.</p>
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
    <footer>
<?php require_once("../../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>