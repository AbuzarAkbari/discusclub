<div class="header">
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

  </div>
<div style="background: #000">
    <div class="container">

        <nav id="primary_nav_wrap">
        <ul>
          <li><a href="/">Home</a>
          </li>
          <li>
            <a class="desktop" href="/about/">Over ons</a>
            <span class="mobile navItem">Over ons</span>
            <ul>
              <li class="mobile"><a href="/about/">Over ons</a></li>
              <li><a href="/about/bestuur">Het bestuur</a>           
                <ul>
                <li><a href="/about/bestuur/jan">Naam bestuurslid 1</a></li>
                 <li><a href="/about/bestuur/karel">Naam bestuurslid 2</a></li>
                <li><a href="/about/bestuur/peter">Naam bestuurslid 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a class="desktop" href="/houden-van">Houden van</a>
              <span class="mobile navItem">Houden van</span>
              <ul>
                  <li class="mobile"><a href="/houden-van">Houden van</a></li>
              <?php if ($logged_in) { ?>
              <li><a href="/houden-van/kweken">Kweken</a></li>
              <li><a href="/houden-van/ziektes">Ziektes</a></li>
            <?php } ?>
            </ul>
          </li>
          <li><a href="/news/">Nieuws</a></li>
          <li><a href="/wordlid">Word lid!</a></li>
          <li><a class="desktop" href="/album">Albums</a>
              <span class="mobile navItem">Albums</span>
              <ul>
                  <li class="mobile"><a href="/album/">Albums</a></li>
              <?php if ($logged_in) { ?>
              <li><a href="/album/upload">Upload</a></li>
            <?php } ?>
        </ul>
          </li>
          <li><a class="desktop" href="/aquarium">Aquaria</a>
              <span class="mobile navItem">Aquaria</span>
              <ul>
                  <li class="mobile"><a href="/aquarium/">Aquaria</a></li>
              <?php if ($logged_in) { ?>
              <li><a href="/aquarium/upload">Upload</a></li>
            <?php } ?>
        </ul>
          </li>
          <li><a class="desktop" href="/forum">Forum</a>
              <span class="mobile navItem">Forum</span>

              <ul>
                  <li class="mobile"><a href="/forum/">Forum</a></li>
              <?php if ($logged_in) { ?>
              <li><a href="/forum/active-topics">Actieve topics</a></li>
              <li><a href="/forum/new-topics">Nieuwe topics</a></li>
              <li><a href="/forum/fav-topics">Favoriete topics</a></li>
            <?php } ?>
        </ul>
          </li>
          <li><a class="desktop" href="/sponsor/become">Sponsoren</a>
              <span class="mobile navItem">Sponsoren</span>

            <ul>
                <li class="mobile"><a href="/sponsor/become">Sponsoren</a></li>
              <li><a href="/sponsor/become">Ook sponsor worden?</a></li>
              <li><a href="/sponsor">Onze sponsoren</a></li>
            </ul>
          </li>
          <li><a href="/contact">Contact</a></li>
          <?php if ($logged_in && in_array($current_level, $admin_levels)) {
              $sth = $dbc->prepare("SELECT count(*) as amount FROM sponsor WHERE approved = 0");
              $sth->execute([":id" => $_SESSION["user"]->id]);
              $sth1 = $dbc->prepare("SELECT count(*) as amount FROM approval_signup JOIN user on user.id = approval_signup.user_id");
              $sth1->execute([":id" => $_SESSION["user"]->id]);
              ?>
          <li><a class="desktop" href="/admin/">Admin</a>
              <span class="mobile navItem">Admin</span>

            <ul>
                <li class="mobile"><a href="/admin">Admin</a></li>
                <li><a href='/admin/ip-list'>IP Lijst</a></li>
                <li><a href='/admin/contest'>Contest</a></li>
                <li><a href='/admin/user-list'>Ledenlijst</a></li>
                <li><a href='/admin/approval-signup'>Inschrijvingen(<?php echo $sth1->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                <li><a href='/admin/approval-sponsor'>Sponsoren(<?php echo $sth->fetch(PDO::FETCH_OBJ)->amount; ?>)</a></li>
                <li><a href="/admin/page">Bewerk houden van</a></li>
                <li><a href="/phpmyadmin">phpmyadmin</a></li>
            </ul>
          </li>
            <?php } ?>
        </ul>
        <li class="icon" id="icon"><a><i class="glyphicon glyphicon-menu-hamburger"></i></a></li>
        </nav>
    </div>
</div>
<script>
    document.querySelector("#icon").addEventListener("click", (e) => {
      document.querySelectorAll("#primary_nav_wrap ul li").forEach((x) => {
        x.classList.toggle("jan");
      });
    });
    document.querySelectorAll("span.mobile").forEach((x, i) => {
      x.addEventListener("click", (e) => {
          e.target.nextElementSibling.classList.toggle("peter");
      });
    })

</script>
