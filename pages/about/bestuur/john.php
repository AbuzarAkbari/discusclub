<?php require_once("../../../includes/tools/security.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("../../../includes/components/head.php"); ?>
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
                <li class="active">John Maas</li>
            </ol>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary ">
                <div class="panel-heading border-colors">John Maas- voorzitter DCH</div>
                <div class="panel-body padding-padding space">
                    <p class="col-md-8">
                        In 1975 ben ik begonnen met mijn eerste aquarium, destijds nog een stalen frame met ruiten in stopverf, wel RVS, dat was al heel wat. In de loop der jaren heb ik buiten discusvissen, heel wat bakken en soorten vissen gehad, tot in totaal misschien we een stuk of 20 thuis, overal waar ik een hoekje vrij had. Veel gekweekt, ook met van alle soorten vissen wel. En vanzelfsprekend met discusvissen. Ondertussen zijn we ruim 40 jaar verder, dus heb ik wel het nodige uitgeprobeerd en gedaan. En nog ben ik er dagelijks mee bezig.
                    </p>
                    <div class="col-md-4">
                        <img src="/images/bestuur/john.jpg" class="John">
                    </div>
                    <p class="col-md-12">
                        <br>
                        In 2013, ben ik lid geworden van DCH, en in 2016, op de algemene leden vergadering, waar al geruime tijd van tevoren bestuursleden werden gevraagd, heb ik op dat moment besloten me aan te melden als bestuurslid, in eerste instantie als secretaris, later in 2017, toen Marcel van Hintum aftrad als voorzitter, heb ik de taak van voorzitter op me genomen.
                        Op diezelfde vergadering, stelden ook Jason en Rob zich niet meer verkiesbaar, zodat we met 4 man overbleven, inmiddels nog maar drie.
                        Ondanks dat proberen we er het beste van te maken en hoop ik, ook namens mijn mede bestuursleden dat we de club levend en actief kunnen houden.
                    </p>
                </div>
            </div>
        </div>
        <?php require '../../../includes/components/advertentie.php'; ?>

    </div>
</div>

<footer>
    <?php require_once("../../../includes/components/footer.php") ; ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
