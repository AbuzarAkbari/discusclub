<?php require_once("includes/tools/security.php"); ?>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
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
        require('includes/components/slider.php');

        $result = $dbc->prepare("SELECT * FROM `topic` JOIN sub_category ON category_id JOIN user ON user_id WHERE state_id = 3");
        $result->execute();
        $text = $result->fetch(PDO::FETCH_ASSOC);
      ?>
    <div class="container main">
        <div class="row">
            <br><br>
            <h1><?php echo $text['title']; ?></h1>

            <div class="col-md-12 ">
                <div class="verticalLine ">
                    <div class="verticalLineRuimte">
                        Categorie: <?php echo $text['name']; ?> | <?php echo $text['created_at']; ?>
                        <br><br>
                        <?php echo $text['content']; ?>
                        <br><br> <?php echo ucfirst($text['first_name']) ." ".  ucfirst($text['last_name']); ?>
                        <br><br> <?php echo ucfirst($text['signature']); ?>
                    </div>
                </div>
                <br><br>
            </div>
            <br><br>
            <div class="">
                <div class="col-md-6">
                    <div class="panel panel-default ">
                        <div class="panel-heading border-color-black">Nieuws reacties</div>
                        <div class="panel-body">
                            <?php
                                $sth = $dbc->prepare("SELECT *, news_reply.content, news_reply.id, news.id as news_id FROM news_reply JOIN news ON news.id = news_reply.news_id ORDER BY news_reply.created_at DESC LIMIT 5");
                                $sth->execute();
                                $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                                foreach($res as $key => $value) : ?>
                                <div class="box">
                                    <div class="col-md-12">
                                        <a href="/about/news/<?php echo $value['news_id']; ?>">
                                            <div class="col-md-3"><img src="<?php  ?>"></div>
                                            <div class="col-md-9">
                                                <p class="title-box-color">
                                                    <b><?php echo $value["title"]; ?></b>
                                                </p>
                                                <p>
                                                <?php echo strlen($value["content"]) > 45 ? substr($value["content"], 0, 45) . "..." : $value["content"]; ?>
                                                <p>
                                                <?php
                                                    if(sizeof($res)-1 != $key) {
                                                        echo "<hr>";
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">

                        <div class="nieuws-box">
                            <div class="panel-heading border-color-black">Ander nieuws</div>
                            <div class="panel-body ">
                                <?php
                                    $sth = $dbc->prepare("SELECT * FROM news");
                                    $sth->execute();
                                    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($res as $key => $value) : ?>
                                    <div class=" col-md-12 verticalLine">
                                        <p><b><?php echo  $value['title']; ?></b></p>
                                        <?php echo strlen($value["content"]) > 200 ? substr($value['content'],0 ,200) . "..." : $value["content"];
                                         ?>
                                        <br><br>
                                        <a href="/about/news/<?php echo $value['id'];?>"><button class="lees-meer-btn" type="button" name="button">Lees meer</button></a>
                                        <br><br>
                                    </div>
                                    <br><div class="col-md-12"><br></div>

                                    <?php endforeach; ?>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php require 'includes/components/footer.php' ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
<!-- https://twitter.com/DiscusHolland -->
