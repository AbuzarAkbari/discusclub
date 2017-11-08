<div class="header">
<div class="container-fluid headerzijkant">

</div>
    <div class="header container">
        <?php if ($logged_in) { ?>
            <?php $name =  $_SESSION["user"]->first_name.' '.$_SESSION["user"]->last_name; ?>
      <div class='inlog'>
        <div class='dropdown'>
          <a href="/user/" class='dropbtn'><?php echo $name; ?></a>
          <div class='dropdown-content'>
            <a href='/user/messenger'>Berichten(<?php
                $sth = $dbc->prepare("SELECT count(*) as amount FROM message WHERE user_id_2 = :id AND opened = 0");
                $sth->execute([":id" => $_SESSION["user"]->id]);
                echo $sth->fetch(PDO::FETCH_OBJ)->amount;
            ?>)</a>
            <a href='/user/conf'>Profiel aanpassen</a>
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
    <div class="nav-wrapper-mobile">
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
                            <a class='dropdown-toggle'>Over ons</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/about/'>Over ons</a></li>
                                <li><a href='/about/origin'>Ontstaan Discus Club Holland</a></li>
                            </ul>
                        </li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle'>Houdenvan</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/houden-van'>Houdenvan</a></li>
                            </ul>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/houdenvan/kweken'>Kweken</a></li>
                                    <li><a href='/houdenvan/'>Houden van</a></li>
                                    <li><a href='/houdenvan/ziektes'>Ziektes</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li><a href='/news/'>Nieuws</a></li>
                        <li><a href='/wordlid'>Word lid!</a></li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle'>Albums</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/album/'>Albums</a></li>
                                    <li><a href='/album/upload'>Upload</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle'>Aquaria</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/album/'>Aquaria</a></li>
                                    <li><a href='/album/upload'>Upload</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle'>Forum</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/forum/'>Forum</a></li>
                            </ul>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/forum/'>Forum</a></li>
                                    <li><a href='/forum/active-topics'>Actieve topics</a></li>
                                    <li><a href='/forum/new-topics'>Nieuw topics</a></li>
                                    <li><a href='/forum/fav-topics'>Favoriete topics</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class='dropdown'>
                            <a class='dropdown-toggle'>Sponsoren</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/sponsor/become'>Sponsoren</a></li>
                                <li><a href='/sponsor/become'>Ook sponsor worden?</a></li>
                                <li><a href='/sponsor'>Onze sponsoren</a></li>
                            </ul>
                        </li>
                        <li><a href='/contact'>Contact</a></li>
                        <?php if ($logged_in && in_array($current_level, $admin_levels)) {
                            $sth = $dbc->prepare("SELECT count(*) as amount FROM sponsor WHERE approved = 0");
                            $sth->execute([":id" => $_SESSION["user"]->id]);
                            $sth1 = $dbc->prepare("SELECT count(*) as amount FROM approval_signup JOIN user on user.id = approval_signup.user_id");
                            $sth1->execute([":id" => $_SESSION["user"]->id]);
                            ?>
                            <li class='dropdown'>
                                <a class='dropdown-toggle'>Admin</a>
                                <ul class='dropdown-menu'>
                                    <li><a href='/admin/'>Admin</a></li>
                                    <li><a href='/admin/contest'>Contest</a></li>
                                    <li><a href='/admin/ip-list'>IP Lijst</a></li>
                                    <li><a href='/admin/user-list'>Ledenlijst</a></li>
                                    <li><a href='/admin/approval-signup'>Inschrijvingen(<?php echo $sth1->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                                    <li><a href='/admin/approval-sponsor'>Sponsoren(<?php echo $sth->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                                    <li><a href="/phpmyadmin">phpmyadmin</a></li>
                                </ul>
                            </li>

                        <?php } ?>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
    <div class="nav-wrapper-pc">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div id='navbar' class='navbar-collapse collapse'>
                    <ul class='nav navbar-nav'>
                        <li><a href='/'>Home</a></li>
                        <li class='dropdown'>
                            <a href='/about/' class='dropdown-toggle'>Over ons</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/about/origin'>Ontstaan Discus Club Holland</a></li>
                            </ul>
                        </li>
                        <li class='dropdown'>
                            <a href='/houden-van' class='dropdown-toggle'>Houden van</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/houdenvan/kweken'>Kweken</a></li>
                                    <li><a href='/houdenvan/ziektes'>Ziektes</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li><a href='/news/'>Nieuws</a></li>
                        <li><a href='/wordlid'>Word lid!</a></li>
                        <li class='dropdown'>
                            <a href='/album/' class='dropdown-toggle'>Albums</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/album/upload'>Upload</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class='dropdown'>
                            <a href='/aquarium/' class='dropdown-toggle'>Aquaria</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/album/upload'>Upload</a></li>
                                </ul>
                            <?php } ?>
                        </li>
                        <li class='dropdown'>
                            <a href='/forum/' class='dropdown-toggle'>Forum</a>
                            <?php if ($logged_in) { ?>
                                <ul class='dropdown-menu'>
                                    <li><a href='/forum/active-topics'>Actieve topics</a></li>
                                    <li><a href='/forum/new-topics'>Nieuwe topics</a></li>
                                    <li><a href='/forum/fav-topics'>Favoriete topics</a></li>
                                </ul>
                            <?php } ?>
                        </li>

                        <li class='dropdown'>
                            <a  href='/sponsor/become' class='dropdown-toggle'>Sponsoren</a>
                            <ul class='dropdown-menu'>
                                <li><a href='/sponsor/become'>Ook sponsor worden?</a></li>
                                <li><a href='/sponsor'>Onze sponsoren</a></li>
                            </ul>
                        </li>
                        <li><a href='/contact'>Contact</a></li>
                        <?php if ($logged_in && in_array($current_level, $admin_levels)) {
                            $sth = $dbc->prepare("SELECT count(*) as amount FROM sponsor WHERE approved = 0");
                            $sth->execute([":id" => $_SESSION["user"]->id]);
                            $sth1 = $dbc->prepare("SELECT count(*) as amount FROM approval_signup JOIN user on user.id = approval_signup.user_id");
                            $sth1->execute([":id" => $_SESSION["user"]->id]);
                            ?>
                            <li class='dropdown'>
                                <a href='/admin/' class='dropdown-toggle'>Admin</a>
                                <ul class='dropdown-menu'>
                                    <li><a href='/admin/ip-list'>IP Lijst</a></li>
                                    <li><a href='/admin/contest'>Contest</a></li>
                                    <li><a href='/admin/user-list'>Ledenlijst</a></li>
                                    <li><a href='/admin/approval-signup'>Inschrijvingen(<?php echo $sth1->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                                    <li><a href='/admin/approval-sponsor'>Sponsoren(<?php echo $sth->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                                    <li><a href="/phpmyadmin">phpmyadmin</a></li>
                                </ul>
                            </li>

                        <?php } ?>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>
