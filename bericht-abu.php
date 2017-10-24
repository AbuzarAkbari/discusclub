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
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- summernote css -->
    <link rel="stylesheet" href="css/summernote.css">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
    require 'slider.php';
    ?>

    <div class="container">
        <div class="row">
            <br><br>
            <div class="panel panel-primary ">
                <div class="panel-heading border-color-blue"> <h3>Welkom</h3></div>
                <div class="panel-body padding-padding">
                    <div class="col-md-12 verticalLine">
                        <h4>Welkom bij Discus Club Holland!</h4>
                        <div class="">
                        Categorie: <a> Website </a> | <span>04-01-2014</span><br>
                        Beste Lezer,<br>
                        <br><br>
                        De ” koning van de Amazone”  heeft Uw aandacht getrokken. U heeft reeds discusvissen in uw  bezit of overweegt deze te gaan aanschaffen, misschien wilt U er op den duur zelfs mee gaan kweken.
                        Het houden van  discusvissen (nakweek) is, als u zich aan de richtlijnen houdt, niet lastig. Voor wildvang vissen gelden trouwens andere eisen en dit is mijns inziens dan ook meer voor de ervaren aquariaan. De discus is een sterke vis die bij goede verzorging behoorlijk oud kan worden. Het houden van deze vissen krijgt een extra dimensie als er in uw aquarium spontaan een koppeltje wordt gevormd dat daadwerkelijk eieren af gaat zetten. Dan slaat bij vele hobbyisten het ”Discusvirus” toe en komt de wens om een kweekpoging te wagen. Voor al deze zaken heeft U kennis nodig die u bij onze vereniging in ruime mate kunt vinden.
                        Maar let wel:  Het dieren welzijn staat op de eerste plaats. U bent immers verantwoordelijk voor Uw dieren, er zijn vele aspecten die een bijdrage aan het welzijn kunnen leveren. Kijk daarom eens goed op deze site en bedenk daarbij :
                        <br><br>
                        Discus Club Holland heeft naast honderden leden die veel kennis en ervaring hebben ook diverse specialisten (bijvoorbeeld op het gebied van visziekten) die u kunnen helpen bij het  voorkomen van teleurstellingen in uw hobby.
                        <br><br>
                        Voor slechts 25 euro per jaar krijgt u niet alleen toegang tot dit netwerk maar ontvangt u ook 4x per jaar ons full color clubblad en bent u van harte welkom op onze informatieve en bovenal gezellige clubavonden. Ik kan u verzekeren dat het lidmaatschap van Discus Club Holland de beste investering is die u, als u echt goed voor uw vissen wil zorgen, kunt doen. Ik heet u graag welkom bij onze club..

                        <br><br><br><br>

                        Marcel van Hintum
                        <br><br>
                        Voorzitter Discus Club Holland
                    <br><br>
                    </div>

                </div>
            </div>
        </div>
        <br>
        </div>
        </div>
        <br><br>

    <div class="row ">
      <div class="conainter-fluid"></div>
      <div class="container">

          <div class="panel panel-primary ">
              <div class="panel-heading border-color-blue">Reacties</div>
              <div class="panel-heading border-color-black "> #23   Geplaatst door  marco.middelhuis    op zondag 23 februari 2014 10:39:39</div>
              <div class="panel-body padding-padding">
                  <div>
                    het contact formulier werkt niet
                </div>
              </div>
              <div class="panel-heading border-color-black"> #23    Geplaatst door  marco.middelhuis    op zondag 23 februari 2014 10:39:39</div>
              <div class="panel-body padding-padding">
                  <div>
                    het contact formulier werkt niet
                </div>
              </div>
              <div class="panel-heading border-color-black"> #23    Geplaatst door  marco.middelhuis    op zondag 23 februari 2014 10:39:39</div>
              <div class="panel-body padding-padding">
                  <div>
                    het contact formulier werkt niet
                </div>
              </div>
          </div>
          <br>
          <div class=" panel-default border-note ">
              <div class="panel-heading border-color-black">Reactie Toevoegen</div>
              <textarea required class="form-control editor maring" col="8" rows="20" name="reply_content"
                        style="resize: none;" placeholder="Uw bericht.."></textarea>
              </div>
              </div>
          </div>
    </div>
  </div>
      </div>
    <div class="conainter-fluid"></div>
    <footer>
<?php require 'footer.php' ; ?>
    </footer>


    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- summernote js -->
    <script type="text/javascript" src="js/summernote.min.js"></script>
    <script>
        $('.editor').summernote({
            codemirror: {
                theme: 'yeti'
            }
        });
    </script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->
