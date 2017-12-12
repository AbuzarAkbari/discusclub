<?php require_once("includes/tools/security.php"); ?>
<?php
    $aquariumSql = "SELECT *, (SELECT COUNT(*) AS amount_of_likes FROM `like` as l LEFT JOIN contest as c ON c.id = l.contest_id LEFT JOIN aquarium as a ON a.id = l.aquarium_id LEFT JOIN image as i ON i.aquarium_id = l.aquarium_id LEFT JOIN user as u ON u.id = a.user_id WHERE c.end_at <= NOW() AND c.deleted_at IS NULL GROUP BY c.start_at, l.aquarium_id ORDER BY c.end_at DESC LIMIT 1) as amount_of_likes FROM `like` as l LEFT JOIN contest as c ON c.id = l.contest_id LEFT JOIN aquarium as a ON a.id = l.aquarium_id LEFT JOIN image as i ON i.aquarium_id = l.aquarium_id LEFT JOIN user as u ON u.id = a.user_id WHERE c.end_at <= NOW() AND c.deleted_at IS NULL GROUP BY c.start_at, l.aquarium_id ORDER BY c.end_at DESC, amount_of_likes DESC LIMIT 1";
    $aquariumResult = $dbc->prepare($aquariumSql);
    $aquariumResult->execute();
    $aquarium = $aquariumResult->fetch();

    setlocale(LC_ALL,'nl_NL.UTF-8', 'Dutch_Netherlands', 'Netherlands');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discusclub Holland</title>
    <?php require_once("includes/components/head.php"); ?>
</head>

<body><!-- Global site tag (gtag.js) - Google Analytics --><script async src="https://www.googletagmanager.com/gtag/js?id=UA-110090721-1"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-110090721-1');</script>
    <div id="fb-root"></div>
    <script>
        ;
        (function(d, s, id) {
            var js,
                fjs = d.getElementsByTagName(s)[0]
            if (d.getElementById(id)) return
            js = d.createElement(s)
            js.id = id
            js.src = '//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10'
            fjs.parentNode.insertBefore(js, fjs)
        })(document, 'script', 'facebook-jssdk')
    </script>
    <?php
        require_once("includes/components/nav.php");
        require_once("includes/components/slider.php");
      ?>
    <div class="container main">
        <div class="row">
            <br><br>

            <h1>Welkom
                <?php
                // echo $text['title']; ?>
            </h1>

            <div class="col-md-12 ">

                    <div class="verticalLine ">
                        <div class="verticalLineRuimte">
                            <?php
                            // echo isset($text['name']) ? $text['name'] : ''; ?>  <?php
                            // echo isset($text['created_at']) ? $text['created_at'] : ''; ?>
                            <?php
                            // echo html_entity_decode($text['content']); ?>
                            <p>Goed dat u even komt kijken of u wat wijzer kunt worden over het houden van discusvissen.<br>
                            Onze vereniging DCH is opgezet om kennis te verzamelen rond de discusvis en deze te verspreiden onder de liefhebbers/hobbyisten. Maar ook om de discussie aan te gaan hoe het misschien beter of anders kan. Hierdoor ontstaat er een mooi naslagwerk waar je van beginner tot professional je kennis kunt vergaren.<br>
                            Zaken die onder andere aan de orde komen zijn:<br>
                            Het inrichten van de biotoop,<br>
                            Waterwaarden,<br>
                            Visverzorging,<br>
                            Kweek.<br>
                            We hopen dat u bij ons een stuk wijzer kan worden en dagen u uit actief deel te nemen aan de ontwikkeling van de kennis rondom het houden van discusvissen.<br>
                        </p>
                        </div>
                    </div>
                <br><br>
            </div>
            <?php if($aquarium): ?>
            <br><br>
            <div class="col-md-12">
                    <div class="panel panel-default ">
                        <div class="panel-heading border-color-black">Winnaar wedstrijd</div>
                        <div class="panel-body">
                            Gefeliciteerd <a href="/user/<?php echo $aquarium['user_id']; ?>"><?php echo $aquarium['first_name'].' '.$aquarium['last_name']; ?></a>, <br><br>
                            Jij hebt de wedstrijd van <?php echo strftime("%A %e %B %Y %T", strtotime($aquarium['start_at'])); ?> tot <?php echo strftime("%A %e %B %Y %T", strtotime($aquarium['end_at'])); ?> gewonnen
                            met <?php echo $aquarium['amount_of_likes']; ?> <?php echo ($aquarium['amount_of_likes'] > 1) ? 'visjes' : 'visje' ; ?><br><br>
                            <a href="/aquarium/post/<?php echo $aquarium['aquarium_id']; ?>">
                                <img src="images/<?php echo $aquarium['path']; ?>" class="contest_winnaar" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <br><br>
            <div class="">
                <div class="col-md-12">
                    <div class="panel panel-default">

                        <div class="nieuws-box">
                            <div class="panel-heading border-color-black">Nieuws</div>
                            <div class="panel-body ">
                                <?php
                                $sth = $dbc->prepare("SELECT * FROM news JOIN news_permission AS np ON np.news_id = news.id WHERE np.role_id = :role_id ORDER BY news.created_at LIMIT 5");
                                $sth->execute([":role_id" => $_SESSION['user']->role_id]);
                                $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                                if(!empty($res)) :
                                foreach($res as $key => $value) : ?>
                                    <div class=" col-md-6 verticalLine">
                                        <p><b><?php echo strip_tags($value['title']);?></b></p>
                                        <?php echo strlen($value["content"]) > 200 ? substr(strip_tags($value['content']),0 ,55) . "..." : strip_tags($value["content"]);
                                        ?>
                                        <br><br>
                                        <a href="/news/post/<?php echo $value['id'];?>"><button class="lees-meer-btn" type="button" name="button">Lees meer</button></a>
                                        <br><br>
                                    </div>
                                    <br><div class="col-md-12"><br></div>

                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr><td>Geen nieuws gevonden</td></tr>
                                <?php endif ;?>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="col-md-6">-->
<!--                    <div class="panel panel-default ">-->
<!--                        <div class="panel-heading border-color-black">Reacties op nieuws</div>-->
<!--                        <div class="panel-body">-->
<!--                            --><?php
//                                $sth = $dbc->prepare("SELECT *, news_reply.content, news_reply.id, news.id as news_id FROM news_reply JOIN news ON news.id = news_reply.news_id JOIN news_permission AS np ON np.news_id = news.id WHERE np.role_id = :role_id ORDER BY news_reply.created_at DESC LIMIT 5");
//                                $sth->execute([":role_id" => $_SESSION['user']->role_id]);
//                                $res = $sth->fetchAll(PDO::FETCH_ASSOC);
//
//                                if(!empty($res)) :
//                                foreach($res as $key => $value) : ?>
<!--                                <div class="box">-->
<!--                                    <div class="col-md-12">-->
<!--                                        <a href="/news/post/--><?php //echo $value['news_id']; ?><!--">-->
<!--                                            <div class="col-md-12">-->
<!--                                                <p class="title-box-color">-->
<!--                                                    <b>--><?php //echo html_entity_decode($value["title"]); ?><!--</b>-->
<!--                                                </p>-->
<!--                                                <p>-->
<!--                                                --><?php //echo strlen($value["content"]) > 45 ? substr(strip_tags($value["content"]), 0, 45) . "..." : html_entity_decode($value["content"]); ?>
<!--                                                <p>-->
<!--                                                --><?php
//                                                    if(sizeof($res)-1 != $key) {
//                                                        echo "<hr>";
//                                                }
//                                                ?>
<!--                                            </div>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                --><?php //endforeach; ?>
<!--                                 --><?php //else : ?>
<!--                                <tr><td>Geen reacties gevonden</td></tr>-->
<!--                                --><?php //endif ;?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
        <?php require 'includes/components/advertentie.php'; ?>
    </div>
    <footer>
        <?php require 'includes/components/footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Discus Club Holland -->

</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
