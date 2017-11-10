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
        <div class="topnav" id="myTopnav">
            <a href="/">Home</a>
            <a href="/about/">Overons</a>
                <a href='/about/origin'>Ontstaan Discus Club Holland</a>



            <a href='/houden-van' class='dropdown-toggle'>Houden van</a>
            <a href='/houden-van/kweken'>Kweken</a>
            <a href='/houden-van/ziektes'>Ziektes</a>
            <a href='/news/'>Nieuws</a>
            <a href='/wordlid'>Word lid!</a>
            <a href='/album/' class='dropdown-toggle'>Albums</a>
            <a href='/album/upload'>Upload</a>
            <a href='/aquarium/' class='dropdown-toggle'>Aquaria</a>
            <a href='/aquarium/upload'>Upload</a>
            <a href='/forum/' class='dropdown-toggle'>Forum</a>
            <a href='/forum/active-topics'>Actieve topics</a>
            <a href='/forum/new-topics'>Nieuwe topics</a>
            <a href='/forum/fav-topics'>Favoriete topics</a>
            <a href='/sponsor/become' class='dropdown-toggle'>Sponsoren</a>
            <a href='/sponsor/become'>Ook sponsor worden?</a>
            <a href='/sponsor'>Onze sponsoren</a>
            <a href='/contact'>Contact</a>
            <a href='/admin/' class='dropdown-toggle'>Admin</a>
            <a href='/admin/ip-list'>IP Lijst</a>
            <a href='/admin/contest'>Contest</a>
            <a href='/admin/user-list'>Ledenlijst</a>
            <a href='/admin/approval-signup'>Inschrijvingen</a>
            <a href='/admin/approval-sponsor'>Sponsoren</a>
            <a href="/phpmyadmin">phpmyadmin</a>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
        </div>
    </div>
</div>










<script>
function myFunction() {
    var x = document.getElementById('myTopnav')
    if (x.className === 'topnav') {
        x.className += ' responsive'
    } else {
        x.className = 'topnav'
    }
}
</script>
