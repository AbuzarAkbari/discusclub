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
    </div>
    <br>
    <div class="container main">
        <div class="row">
            <br>
            <div class="">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Over ons</li>
                </ol>
            </div>
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
                        Dit alles voor €25,00 per jaar. Voor die contributie krijgt u in ruil al het bovenstaande en kunt u met trots zeggen dat u ook de status “clublid van DCH” heeft, u behoort tot een uiterst toonaangevende vereniging op internationaal discus-vlak.
                        <br><br>
                        Gezinsleden zijn gratis lid.
                        Op het invulformulier hieronder kunt u zich opgeven als lid.
                        Het lidmaatschap is alleen mogelijk via automatische incasso.
                        Indien er ernstige bezwaren zijn tegen een automatische incasso kunt u contact opnemen met de penningmeester.
                    </p>
                </div>
            </div>
            <?php if(!$logged_in): ?>
                <div class="message warning"><a href="/user/login?redirect=<?php echo $_SERVER['REQUEST_URI']; ?>">Login</a> om verder te gaan.</div>
            <?php endif; ?>
            <?php if($logged_in): ?>
            <?php
            // check if already signed up
            $sth = $dbc->prepare("SELECT * FROM approval_signup WHERE user_id = :id");
            $sth->execute([
                ":id" => $_SESSION["user"]->id
            ]);
            $res = $sth->fetch(PDO::FETCH_OBJ);
            if(!$res && !in_array($_SESSION["user"]->role_name, ["admin", "redacteur", "lid"])) :
            ?>
                <div class="panel panel-primary">
                    <div class="panel-heading panel-heading1">
                        <h4>Inschrijfformulier</h4></div>
                    <div class="panel-body">
                        <form class="" action="/includes/tools/wordlidInsert.php" method="post">
                            <label for="adres">Adres *</label>
                            <div class="input-group">
                                <input required id="adres" type="text" name="adres" class="form-control" placeholder="Adres"/>
                                <span class="input-group-addon"></span>
                                <input required type="text" name="huisnummer" class="form-control" placeholder="Huisnummer"/>
                            </div>
                            <br>
                            <label for="postcode">Postcode *</label>
                            <input id="postcode" class="form-control" required type="text" name="postcode" value="" placeholder="Postcode "><br>
                            <label for="stad">Stad *</label>
                            <input id="stad" class="form-control" required type="text" name="stad" value="" placeholder="Stad "><br>
                            <label for="telefoonnummer">Telefoonnummer *</label>
                            <input id="telefoonnummer" class="form-control" required type="tel" name="telefoonnummer" value="" placeholder="Telefoonnummer "><br>
                            <label for="rekeningnummer">Rekeningnummer *</label>
                            <input id="rekeningnummer" class="form-control" required type="text" name="rekeningnummer" value="" placeholder="Rekeningnummer "><br>
                            <label for="voorwaarden">
                                <input type="checkbox" name="voorwaarden" id="voorwaarden" required>
                                Ik ga akkoord met de <a target="_blank" href="https://discusclubholland.nl/gebruiksvoorwaarden">voorwaarden</a>.
                            </label>
                            <br>
                            <br>
                            <input type="submit" class="btn btn-primary" name="send" value="Verzend">
                        </form>
                    </div>
                </div>
                <?php elseif($res && $res->approved == 0) : ?>
                    <div class="message warning">Uw aanvraag om lid te worden is in behandeling.</div>
                <?php elseif($res && $res->approved == 1) :?>
                    <div class="message warning">Uw aanvraag om lid te worden is in geaccepteerd.</div>
                <?php elseif($res && $res->approved == 2) :?>
                    <div class="message warning">Uw aanvraag om lid te worden is in geweigerd.</div>
                <?php else: ?>
                    <div class="message warning">U bent al lid of hoger.</div>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            // $ad_in_row = true;
            require_once('../includes/components/advertentie.php'); ?>
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
