<?php require_once("includes/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nieuws.css">
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
    <?php
    require_once("includes/nav.php");
    ?>
    <br><br>
    <div class="container">
      <div class="row columns">
      <div class="col-md-8">
        <div class="panel panel-primary">
          <div class="panel-heading border-colors">Sponsoren</div>
          <div class="panel-body padding-padding">
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>
            <div class="col-md-6 col-sm-12 ruimte"><img src="http://via.placeholder.com/280x40"> </div>

          </div>
        </div>
      </div>
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Advertentie</div>
              <div class="panel-body">
                  <div class="col-md-12 col-sm-12 ruimte"><img src="http://via.placeholder.com/320x320"> </div>
              </div>
          </div>
      </div>
    </div>
  </div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
