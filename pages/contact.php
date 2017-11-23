<?php require_once("../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../includes/components/head.php"); ?>
</head>
<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
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
        require_once("../includes/components/nav.php");
    ?>

    <br><br>
    <div class="container main">
      <div class="row">
    <div class="col-md-12">
      <div class="">
      <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Contact</li>
      </ol>
      </div>
    </div>
          <?php if(isset($_GET['msg'])): ?>
              <div class="alert alert-success" role="alert"><?php echo $_GET['msg']; ?></div>
          <?php endif; ?>
      <div class="col-md-8">
        <div class="panel panel-primary ">
          <div class="panel-heading border-color-blue">Stel uw vraag</div>
          <div class="panel-body">
              <form action="/includes/tools/verwerk" method="post">
                <label for="fname">Naam</label>
                <input id="fname" type="text" class="form-control" name="naam" placeholder="Uw naam" required>
                <br>
                <label for="email">E-mail</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="Uw e-mail" required>
                <br>
                <label for="subject">Bericht</label>
                <textarea id="subject" name="bericht" class="form-control" placeholder="Uw bericht" style="height:200px; resize: none;" required></textarea>
                <br>
                <input type="submit" class="btn btn-primary" name="send" value="Verzend">
              </form>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading border-color-blue">Contactgegevens</div>
          <div class="panel-body">
            Inschrijvingen
            <br>
            <br>
            Discus Club Holland
            <br>
            Hoogstraat 7
            <br>
            3552 XJ Utrecht
            <br>
            <br>
            ING Bank:  4264289
            <br>
            IBAN:         NL51INGB0004264289
            <br>
            BIC:            INGBNL2A
            <br>
            KvK:           30158931
            <br>
          </div>
        </div>
      </div>
      <?php require_once('../includes/components/advertentie.php'); ?>
    </div>
  </div>
  <footer>
    <?php require_once("../includes/components/footer.php") ; ?>
  </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
