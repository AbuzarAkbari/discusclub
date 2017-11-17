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
              <p class="col-md-8">
                  Het was in 1998 dat een paar mensen bij elkaar zijn gaan zitten om eens na te denken over het opzetten van een vereniging bedoeld voor discusvissen liefhebbers.
                  Het doel wat we toen stelden was zoveel mogelijk informatie verzamelen over de discusvis en vooral delen met andere liefhebbers. De oprichting was op 9 mei in café Den Engh in ‘t Goy. En ik was een van die oprichters.
                  In eerste instantie werd ik secretaris. Tot dat een paar leden vonden dat zij beter leiding konden geven aan de vereniging. Zo stapten wij als geheel bestuur op.
                  We hadden toen ongeveer 350 leden.
                  Maar eind 2003 plofte de boel. Het zogenaamde “nieuwe bestuur” had er een puinhoop van gemaakt en werden de laan uitgestuurd, zonder decharge!
                  Er waren toen nog maar krap 200 leden over. Het heeft ons dus 150 leden gekost die grappenmakerij.
                  Vanaf 2004 is toen het oude bestuur onder leiding van Karel van de Heiden als voorzitter opnieuw aangesteld en werd ik, Jan Verkaik, penningmeester en ledenbeheerder.
              </p>
              <div class="col-md-4">
                  <img src="/images/bestuur/jan.PNG">
              </div>
              <p class="col-md-12">
                  <br>
                  De schade aan onze vereniging bleek groter dan gedacht en het heeft lang geduurd voordat er weer vertrouwen was in het bestuur.
                  Dus vanaf begin 2004 tot aan nu toe heb ik, met veel plezier, mijn taken uitgevoerd en gemoderniseerd.
                  Wat voorheen nog met een acceptgiro ging is nu een automatische incasso geworden en dat scheelt enorm veel werk en na controles op wie er nu wel en wie er nu nog niet zijn contributie voldaan heeft.
                  Omdat hier de hele ledenadministratie huisvest mag ik telkens opnieuw nieuwe leden verwelkomen en vastleggen in de administratie. Dan mag ik ook de incasso’s aanmaken en via de bank activeren.
                  Ik mag ook de opzeggers bijhouden en in het ledenbestand een einddatum vastleggen.
                  Het clubblad laten we drukken en verzenden door Euromail. Voorheen mocht ik vier keer per jaar de stickers uitdraaien en op de envelop plakken, het blad insteken en naar de post brengen. Dat hoeft gelukkig niet meer.
                  En ik mag de nieuwsbrief maken van de aangeleverde tekst. Die verstuur ik dan via de email en een kleine twintigtal per post.
                  Adresveranderingen doorvoeren en mensen nabellen omdat ik hun post terug gestuurd heb gekregen. Die waren vergeten hun verhuizing aan mij door te geven.
                  Kortom er is altijd wat te doen. Daarom heb ik in huis een vaste plek. Zie foto.
              </p>

          </div>
        </div>
      </div>
      <?php require '../includes/components/advertentie.php'; ?>

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
