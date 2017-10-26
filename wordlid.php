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
    require_once("includes/nav.php");
    ?>
    </div>
    <div class="container main">
        <div class="row">
            <br><br>
            <div class="panel panel-primary">
                <div class="panel-heading panel-heading1">
                    <h4>Word lid!</h4></div>
                <div class="panel-body">
                    <h4>Beste discusliefhebber,</h4>
                    <p>
                        Discus Club Holland is ’s lands grootste discusvereniging. Met een zeer grote basis aan leden vormen we een stabiele omgeving waar de ervaring doorgegeven wordt van lid tot lid. Moesten we het aantal jaar ervaring met discussen van
                        al onze leden samen tellen, dan spreken we over ettelijke eeuwen aan ervaring.
                        <br><br>
                        U kunt zich ook aansluiten bij onze club en mee profiteren van die ervaring en wijze raad.
                        <br><br>
                        Naast het meedelen in ervaring, tips, trucs en weetjes kunt u als clublid ook nog eens genieten van:
                        <br>
                        <ul>
                            <li>1 Algemene Leden Vergadering waar we u op de hoogte houden van besluiten van de club en u betrekken in de club</li>
                            <li>4 clubavonden per jaar: gastsprekers gaan diep in op thema’s teneinde uw kennis te verruimen</li>
                            <li>4 clubbladen per jaar boordevol leerrijke informatie</li>
                            <li>1 gratis welkomstboekje, een onmisbaar werkstuk om succes verzekerd te hebben bij het houden van discus</li>
                            <li>Digitaal krijgt u als clublid ook toegang tot onze clubbladen</li>
                            <li>Er worden nu en dan kortingen gegeven die enkel voor clubleden beschikbaar zijn (voorbeeld korting AquaVaria 2014)</li>
                            <li>U kunt meehelpen aan verschillende projecten die DCH doet zoals het WereldKampioenschap discussen in oktober 2015 tijdens de AquaVaria beurs</li>
                            <li>....</li>
                        </ul>
                        <br>
                        Dit alles voor €25,00 per jaar. Voor die contributie krijgt u in ruil alle bovenstaande en kunt u met trots zeggen dat u ook de status “clublid van DCH” heeft, u behoort tot een uiterst toonaangevende vereniging op internationaal discus-vla
                        <br><br>
                        Gezinsleden zijn gratis lid.
                        Op het invulformulier hieronder kunt u zich opgeven als lid.
                        Het lidmaatschap is alleen mogelijk via automatische incasso.
                        Indien er ernstige bezwaren zijn tegen een automatische incasso kunt u contact opnemen met de penningmeester.
                    </p>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading panel-heading1">
                    <h4>Inschrijfformulier</h4></div>
                <div class="panel-body">
                    <form class="" action="index.php" method="post">
                        <input class="form-control" required type="text" name="" value="" placeholder="Naam *"><br>
                        <input class="form-control" required type="email" name="" value="" placeholder="Email *"><br>
                        <input class="form-control" required type="text" name="" value="" placeholder="Adres *"><br>
                        <input class="form-control" required type="text" name="" value="" placeholder="Postcode *"><br>
                        <input class="form-control" required type="text" name="" value="" placeholder="Plaats *"><br>
                        <input class="form-control" required type="number" name="" value="" placeholder="Telefoonnummer *"><br>
                        <input class="form-control" required type="text" name="" value="" placeholder="Rekeningnummer *"><br>
                        <input type="submit" class="btn btn-primary" name="send" value="Verzend">
                    </form>
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
