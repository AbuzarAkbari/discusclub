<?php require_once("../../includes/tools/security.php"); ?>
<?php
$search = $_POST['search_area'];
$sql = $dbc->prepare("SELECT * FROM news AS n JOIN news_reply AS nr ON n.id = nr.news_id WHERE n.title LIKE :search OR n.content LIKE :search OR nr.content LIKE :search");
$sql->execute([":search" => isset($search) ? "%" . $search . "%" : "%"]);
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="/css/overons.css">
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
    require_once("../../includes/components/nav.php");
    ?>

    <br><br>
    <div class="container main">
      <?php if ($logged_in) :?>
      <div class="row columns">
          <div class="col-md-12">
              <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/news/">Nieuws</a></li>
                  <li class="active">Zoek nieuws</li>
              </ol>
          </div>
      <div class="col-md-12">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Zoekresultaten</div>
          <div class="panel-body padding-padding space">
            <?php
              echo '<pre>';
              var_dump($res);
              exit;
            ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
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