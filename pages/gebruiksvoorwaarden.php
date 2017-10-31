<?php require_once("../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
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
    <?php require_once("../includes/components/nav.php"); ?>
    </div>
    <div class="container main">
        <div class="row">
          <br><br>
          <div class="panel panel-primary">
              <div class="panel-heading panel-heading1">
                  <h4>Gebruiksvoorwaarden</h4></div>
                <div class="panel-body">
                  <strong>Doestelling forum </strong>
                  <p>Het doel van het forum is, het brengen van informatie omtrent het houden en verzorgen van de discusvis. Dit door de informatie die een ieder heeft of wil hebben te delen op een open medium zoals het internet.</p>

                   <strong>Bericht plaatsing regels:</strong>
                  <ol class="listing">
                    <li>U verklaart geen hatelijke, beschuldigingen, seksuele, bedreigende of elk ander bericht te plaatsen wat tegen de wet indruist.
Indien dit wel gebeurt kan dit leiden tot een directe ban en of permanente ban. Eventueel zal ook de service provider op de hoogte worden gebracht. Het IP adres van alle postings wordt geregistreerd om dit te kunnen bewerkstelligen. U bent het ermee eens dat de Website beheerder, administrator, moderators en het bestuur van Discus Club Holland het recht hebben om berichten te verwijderen, aanpassen, verplaatsen en afsluiten op elk moment dat dit hen uitkomt. </li>
                    <li>Als gebruiker ben u het ermee eens dat alle informatie die u op het forum plaatst wordt opgeslagen in een database.
Deze informatie wordt niet aan derden doorgegeven zonder dat u hiervan op de hoogte bent. Het is niet mogelijk om de Website beheerder, administrator, moderators en het bestuur van Discus Club Holland verantwoordelijk te houden voor welke hack poging welke lijdt tot verlies van deze gegevens.
 </li>
                    <li>
Het Privé Berichten systeem (PM) mag niet worden gebruikt voor het spammen of adverteren.
Dit wordt gecontroleerd door een softwarematige instelling en zal indien het Privé Bericht voldoet aan een aantal criteria worden doorgegeven aan de administrator. Ook moet het Privé Berichten systeem niet worden gebruikt om gebruikers te bedreigen, lastig te vallen. </li>
                    <li>Promotie van commerciële websites, artikelen en discusvissen is niet toegestaan.
Dit is alleen toegestaan voor sponsoren en moderators in het daarvoor bedoelde sub forum Sponsoren en advertenties.</li>
                    <li>Voor leden van Discus Club Holland en verwante verenigingen is de promotie van niet commerciële websites toegestaan in het daarvoor bedoelde sub forum.
Voor "niet-leden" is het wel toegestaan om in hun profiel een link naar hun website te plaatsen mits deze niet van commerciële aard is.</li>
                    <li>
Het plaatsen van linken of verwijzingen direct of indirect naar concurrerende forums vinden wij niet gepast en wordt ook niet geaccepteerd."</li>
                  </ol>
                  <strong>Oneens met elkaar</strong>
                  <p>Indien u het niet eens bent met een Moderator, ga dan niet in discussie maar neem contact op met de Administrator en leg uw probleem voor.</p>
                  <strong>Gebanned! </strong>
                  <p>Het negeren van eerder genoemde gebruikersregels kan leiden tot een tijdelijke Ban of een permanente Ban op ons forum. De periode welke de ban zal duren wordt besproken door de moderators en de administrator.</p>

                  <strong>E-mail adres en Cookie informatie </strong>
                  <p>Dit forum gebruikt cookies om informatie op uw systeem op te slaan.
Deze informatie bevat alleen gegevens omtrent uw inlognaam en wachtwoord. De reden hiervan is dat u niet elke keer deze gegevens hoeft in te typen zodra u het forum wilt gebruiken. Het email adres van uw provider wordt alleen gebruikt voor registratie doeleinden en om te controleren of het een werkend email adres is. Dit is ook nodig voor het geval u uw wachtwoord bent kwijtgeraakt. Het systeem zal u dan een nieuw wachtwoord toezenden naar dit email adres.</p>

                  <strong>Alles wat niet in de gebruikersregels voorkomt. </strong>
                  <p>Alles wat niet beschreven is in de huisregels kan door de Administrator/ moderators in overleg met elkaar worden aangepast.
U gaat ermee Akkoord.</p>


              </div>
          </div>
        </div>
    </div>
    <footer>
<?php require_once("../includes/components/footer.php") ; ?>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
