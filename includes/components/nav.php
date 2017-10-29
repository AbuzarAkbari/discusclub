<div class="header">
<div class="container-fluid headerzijkant">

</div>
    <div class="header container">
        <?php if ($logged_in) { ?>
            <?php $name =  $_SESSION["user"]->first_name.' '.$_SESSION["user"]->last_name; ?>
      <div class='inlog'>
        <div class='dropdown'>
          <a href="/user" class='dropbtn'><?php echo $name; ?></a>
          <div class='dropdown-content'>
            <a href='/user/messenger'>Berichten</a>
            <a href='/user/conf'>Profiel aanpasen</a>
          </div>
      </div>
        <a href="/?logout=true">Uitloggen</a>
      </div>
        <?php } else { ?>
            <div class='inlog'>
                <a href='/user/login'>Inloggen</a>
                <a href='/user/register'>Registreer</a>
                <a href='/user/password/forgot'>Wachtwoord vergeten?</a>
            </div>
        <?php } ?>
        <div class="col-xs-6">
            <a href="/"><img class="logo" src="/images/Discus_Club_Holland_Logo.png" alt="Discusclubholland"></a>
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
                    <li><a href='/'>Home</a></li>
                    <li class='dropdown'>
                        <a href='/about' class='dropdown-toggle'>Over ons</a>
                        <ul class='dropdown-menu'>
                            <li><a href='/about/origin'>Ontstaan Discus Club Holland</a></li>
                            <li><a href='/about/news'>Nieuws</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a href='/forum/' class='dropdown-toggle'>Forum</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/forum/active-topics'>Actieve topics</a></li>
                                    <li><a href='/forum/new-topics'>Nieuw topics</a></li>
                                    <li><a href='/forum/fav-topics'>Favoriete topics</a></li>
                                    <li><a href='/forum/user-list'>Ledenlijst</a></li>
                                </ul>
                            <?php } ?>
                    </li>
                    <li><a href='/wordlid'>Word lid!</a></li>
                    <li class='dropdown'>
                        <a href='/sponsor' class='dropdown-toggle'>Sponsoren</a>
                        <ul class='dropdown-menu'>
                            <li><a href='/sponsor/become'>Ook sponsor worden?</a></li>
                            <li><a href='/sponsor'>Onze sponsoren</a></li>
                        </ul>
                    </li>
                    <li class='dropdown'>
                        <a href='/album' class='dropdown-toggle'>Album</a>
                        <?php if ($logged_in) { ?>
                            <ul class='dropdown-menu'>
                                <li><a href='/album/upload'>Upload</a></li>
                            </ul>
                        <?php } ?>
                    </li>
                <li><a href='/contact'>Contact</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
</nav>
