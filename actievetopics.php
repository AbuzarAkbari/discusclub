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
     require 'ingelogd.php';
      ?>
      <?php
      //  require 'ingelogd.php';
        ?>

    <br><br>
    <div class="container">
      <div class="row columns">
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Nieuws</div>
          <div class="panel-body padding-padding">
            <table>
              <tr>
                <th> #</th>
                <th> Titel</th>
                <th>Forum</th>
                <th>Auteur</th>
                <th>Berichten</th>

                <th>Bekeken</th>
                <th>Laatste bericht</th>
              </tr>
              <tr>
                <td>	&#128193; </td>
                <td>lorem ipsum</td>                <td>lorem ipsum</td>                <td>lorem ipsum</td>
                <td>1</td>
               <td>123</td> <td>1 dage geleden, <br> door henk</td>
              </tr>
              <tr>
                <td>	&#128193; </td>
                <td>lorem ipsum</td>                <td>lorem ipsum</td>                <td>lorem ipsum</td>
                <td>1</td>
                <td>123</td> <td>1 dage geleden, <br> door henk</td>
              </tr>
              <tr>
                <td>	&#128193; </td>
                <td>lorem ipsum</td>                <td>lorem ipsum</td>                <td>lorem ipsum</td>
                <td>1</td>
                <td>123</td> <td>1 dage geleden, <br> door henk</td>
              </tr>
              <div class="panel-heading">

                <tr>
                  <th> #</th>
                  <th> Titel</th>
                  <th>Forum</th>
                  <th>Auteur</th>
                  <th>Berichten</th>

                  <th>Bekeken</th>
                  <th>Laatste bericht</th>
                </tr>

              </div>
                  </div>
            </table>
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
