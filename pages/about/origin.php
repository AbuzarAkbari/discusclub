<?php require_once("../../includes/tools/security.php"); ?>
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
      <div class="row columns">
          <div class="col-md-12">
              <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/about/">Over ons</a></li>
                  <li class="active">Ontstaan</li>
              </ol>
          </div>
      <div class="col-md-7">
        <div class="panel panel-primary ">
          <div class="panel-heading border-colors">Ontstaan Discus Club Holland</div>
          <div class="panel-body padding-padding space">
            Het was in 1998 dat een paar mensen bij elkaar zijn gaan zitten om eens na te denken over het opzetten van een vereniging bedoeld voor discusvissen liefhebbers.
        Het doel wat we toen stelden was zoveel mogelijk informatie verzamelen over de discusvis en vooral delen met andere liefhebbers. De oprichting was op 9 mei in café Den Engh in ‘t Goy. Er waren 94 bezoekers.
        <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>

        Er kwamen steeds meer leden en onze vereniging groeide gestaag. Het aanbod deed zich voor om in Het Haltnahuis in Houten de ontvangsthal en bijruimten mochten gaan gebruiken. Dat was in het jaar 2000.
        <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>

        Het idee ontstond dat we ook andere mensen dan alleen maar de liefhebbers kennis wilde laten maken met onze mooie hobby en zo werd in 2006 een eerste opendag georganiseerd met een kleine beurs er bij. Er kwamen zo’n 500 bezoekers op af. En in 2007 een tweede opendag met maar liefst 22 showbakken en 700 bezoekers.
        <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>

        Het zou toch wel erg mooi zijn dat ook wij als Nederlanders een wedstrijd gingen organiseren. Een heus kampioenschap. Zo gezegd, zo gedaan. Na hard werken met ons allen werd in 2008 het Open Nederlands Kampioenschap Discusvissen een feit. Dat was heus wel een zorgenkindje want er was nog niets. Nog geen ruimte waar dat zou kunnen, nog geen wedstrijdbakken met toebehoren als verwarmingen en pompen. Helemaal niets! En toch moest het een echte wedstrijd worden met echte juryleden en maar liefst 80 wedstrijdbakken. Zo werd voor de gelegenheid de Stadshof in Vianen gehuurd als plaats delict. En dan al die bakken bestellen en over laten komen. De opbouw van het geheel, geen ervaring dus één grote ontdekkingreis. Zullen er wel bezoekers komen of lopen we hier financieel op kapot, dat was de actuele vraag van de dag. Want de huurprijs en de aanschaf van de bakken was voor een vereniging als de onze een echte aderlating en een heel groot risico. Maar de leden van het bestuur gingen er voor. Uiteindelijk bleken er zowat 1000 bezoekers te zijn geweest.
        <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>

        We besloten met elkaar dat dit echt nog een keer opnieuw moest gaan gebeuren en zo werd besloten dit evenement om de twee jaar te gaan organiseren.
        De Stadshof werd te klein en dus moesten we uitwijken naar iets groters. Dat werd in 2010 het oude Helsdingen in Vianen, een sportcomplex. Het tweede ONKD werd een feit met nog meer wedstrijdbakken en een grotere beurs voor de aquariumliefhebbers. Dankzij een aantal vrijwilligers en de leden van het bestuur was het keihard werken.
        <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>

        Dat hebben we in 2012 nog een keertje opnieuw gedaan. Een derde ONKD met 100 wedstrijdbakken en nog meer bezoekers. <h3 class="font-weight-bold">Maar daar bleef het niet bij.</h3>
        In het organiseren van een wedstrijd  was de kennis wel in huis, maar het organiseren van een beurs was niet onze sterkste kant. En zo ontstond er een samenwerking met aquariumvereniging Daphnia die weer erg goed waren in het organiseren van een beurs en ook nog eens de nodige vrijwilligers kende. We konden samen goede afspraken maken en zo werd in 2014 een discusshow gegeven met een grotere beurs in het nieuwe Helsdingen in Vianen onder de naam AquaVaria, ons samenwerkingsverband in een nieuw sportcomplex dat groter is dan het oude.
        Gelukkig waren er een aantal vrijwilligers die ons veel werk uit handen hebben genomen.
        Maar daar blijft het niet bij.

        Als we dan toch vooruit willen, doe het dan goed! En zo zal op 24 en 25 oktober 2015 een heus Wereld Kampioenschap Discusvissen georganiseerd worden tijdens het evenement AquaVaria. En natuurlijk hartstikke samen met aquariumvereniging Daphnia.
        Het voornemen is hiervoor 150 wedstrijd bakken voor te laten aanrukken en, zo als het er nu uitziet, zes klassen. Deze getallen zijn voorlopig definitief, maar kunnen nog veranderen. Daarnaast zal ook De NVC en de NBAT het een en ander gaan organiseren en aanschuiven op AquaVaria. Het wordt leuk!!!!
          </div>
        </div>
      </div>
      <div class="col-md-5">
          <div class="panel panel-primary">
                <div class="panel-heading border-colors">Advertentie</div>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12 ruimte"><a href="/wordlid"><img alt='Advertentie' src="/images/ad/advertentie.jpg"></div></a>
                </div>
          </div>
      </div>
      <div class="col-md-5">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Bekijk de nieuwste albums</div>
              <div class="panel-body">
                  <?php
                      $sth = $dbc->prepare("SELECT *, album.id AS album_id FROM album JOIN image ON image.album_id = album.id ORDER BY created_at DESC LIMIT 6");
                      $sth->execute();
                      $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                      foreach($res as $key => $value) : ?>
                      <div class=" col-md-4 col-sm-4 ruimte"><a href="/album/post/<?php echo $value["album_id"]; ?>"><div  title="image album" class="imgThumbnail" style="background-image: url('/images<?php echo $value['path']?>');"></div></a><br><?php echo $value['created_at']?></div>
                      <?php endforeach; ?>
              </div>
          </div>
      </div>
            <div class="col-md-5">
              <div class="panel panel-primary">
                  <div class="panel-heading border-colors">Laatste reacties op albums</div>
                  <div class="panel-body">
                    <?php
                      $sth = $dbc->prepare("SELECT *, album_reply.created_at AS album_reply_created_at FROM album_reply JOIN album ON album_reply.album_id = album.id ORDER BY album_reply.created_at DESC LIMIT 5");
                      $sth->execute();
                      $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                      foreach($res as $key => $value) : ?>
                      <a href="/album/<?php echo $value['album_id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 laastenieuws"><?php echo $value['title'] ?></a><br><?php echo $value['album_reply_created_at'] ?></div>
                    <?php endforeach; ?>
                  </div>
              </div>
            </div>

      <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading border-colors">Laatste reacties op nieuws</div>
            <div class="panel-body">
                    <?php
                        $sth = $dbc->prepare("SELECT *, news_reply.created_at AS news_reply_created_at FROM news_reply JOIN news ON news_reply.news_id = news.id ORDER BY news_reply.created_at DESC LIMIT 5");
                        $sth->execute();
                        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                        foreach($res as $key => $value) : ?>
                        <a href="/news/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 laastenieuws"><?php echo $value['title'] ?></a><br><?php echo $value['news_reply_created_at'] ?></div>
                        <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-5">
          <div class="panel panel-primary">
              <div class="panel-heading border-colors">Laatste reacties op topics</div>
              <div class="panel-body">
                    <?php
                    $sth = $dbc->prepare("SELECT * FROM topic ORDER BY created_at DESC LIMIT 5");
                    $sth->execute();
                    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                    foreach($res as $key => $value) : ?>
                    <a href="/forum/post/<?php echo $value['id']; ?>" class="blauwtxt"><div class="col-md-12 col-sm-12 laastenieuws"><?php echo $value['title'] ?></a><br><?php echo $value['created_at'] ?></div>
                    <?php endforeach; ?>
                </div>
          </div>
        </div>
      </div>
      <div class="col-md-8"></div>
      <div class="col-md-8"></div>
    </div>

        <?php require ('../../includes/components/advertentie.php'); ?>
  </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
