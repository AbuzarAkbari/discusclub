<div class="header">
<div class="container-fluid headerzijkant">

</div>
    <div class="header container">
        <?php if ($logged_in) { ?>
            <?php $name =  $_SESSION["user"]->first_name.' '.$_SESSION["user"]->last_name; ?>
      <div class='inlog'>
        <div class='dropdown'>
          <a href="gebruiker" class='dropbtn'><?php echo $name; ?></a>
          <div class='dropdown-content'>
            <a href='bericht.php'>Berichten </a>
            <a href='profiel-aanpassen.php'>Profiel aanpasen </a>
          </div>
      </div>
        <a href="index.php?logout=true">Uitloggen</a>
      </div>
        <?php } else { ?>
            <div class='inlog'>
                <a href='inloggen.php'>Inloggen</a>
                <a href='registeren.php'>Registreer</a>
                <a href='wachtwoordvergeten.php'>Wachtwoord vergeten?</a>
            </div>
        <?php } ?>
        <div class="col-xs-6">
            <a href="/"><img class="logo" src="images\Discus_Club_Holland_Logo.png" alt="Discusclubholland"></a>
        </div>
    </div>
    <div class="container-fluid headerzijkant">

    </div>
  </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </button>
            </div>
            <div id='navbar' class='navbar-collapse collapse'>
                <ul class='nav navbar-nav'>
                    <li><a href='index.php'>Home</a></li>
                    <li class='dropdown'>
                        <a href='overons.php' class='dropdown-toggle'>Over ons </a>
                        <ul class='dropdown-menu'>
                            <li><a href='ontstaan.php'>Onstaan Discus Club Holland</a></li>
                            <li><a href='nieuws.php'>Nieuws</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a href='form.php' class='dropdown-toggle'>Forum </a>
                        <ul class='dropdown-menu'>
                            <li><a href='actievetopics.php'>Actieve topics</a></li>
                            <li><a href='nieuwetopics.php'>Nieuw topics</a></li>
                            <?php if ($logged_in) { ?>
                                <li><a href='fav-topics.php'>Favoriete topics</a></li>
                                <li><a href='ledenlijst.php'>Ledenlijst</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href='wordlid.php'>Word lid!</a></li>
                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle'>Sponsoren </a>
                        <ul class='dropdown-menu'>
                            <li><a href='sponsoren-worden.php'>Ook sponsor worden?</a></li>
                            <li><a href='sponsoren.php'>Onze sponsoren</a></li>
                        </ul>
                    </li>
                    <li><a href='albums.php'>Albums</a></li>
                    <li><a href='contact.php'>Contact</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
</nav>
