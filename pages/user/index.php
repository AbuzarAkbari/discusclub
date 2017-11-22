<?php $levels = ["gebruiker", "lid"];
require_once("../../includes/tools/security.php"); ?>
<?php
if (isset($_GET["id"])) {
    require_once("../../includes/tools/const.php");
    $sth = $dbc->prepare($USER_SELECT . " WHERE u.id = :id");
    $sth->execute([":id" => $_GET["id"]]);

    $user_data = $sth->fetch(PDO::FETCH_OBJ);
} else {
    $user_data = $_SESSION["user"];
}

if($user_data == false){
        echo "<div class='message error'>test</div>";
        header('Location: /user/');
      }

//      die($user_data->id);


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Discusclub Holland</title>
        <?php require_once("../../includes/components/head.php"); ?>
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
        <?php require_once("../../includes/components/nav.php"); ?>
        <br><br>

        <div class="container main">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Gebruiker</li>
                </ol>
            </div>
            <br>
            <!--        <div class="col-md-12">-->
            <!--            <div class="panel panel-primary border-color-blues">-->
            <!--                <div class="panel-heading border-color-blue">Gebruiker</div>-->
            <!--                <div class="panel-body text-right">-->
            <!--                    <a><input type="submit" class="btn btn-primary" name="send" value="Fotoalbums"></a>-->
            <!--                    <a href="/user/conf"><input type="submit" class="btn btn-primary" name="send" value="Wijzig profiel"></a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="col-md-4">

                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue"><?php echo $user_data->first_name.' '.$user_data->last_name; ?></div>
                        <div class="panel-body text-left">
                            <div class="text-center">
                                <div style="background-image:url('/images<?php echo isset($user_data->profile_img) ? $user_data->profile_img : " "; ?>')"; class="img profile_img"></div>
                            </div>
                            <div class="col-md-12">
                                <strong>Locatie</strong><br>
                                <?php if($user_data->city != "") : ?>
                                    <?php echo $user_data->city; ?>
                                <?php else: ?>
                                    <span style="color: lightgray;">Geen locatie bekend</span>
                                <?php endif; ?><br>
                                <strong>Leeftijd</strong><br>
                                <?php $leeftijd = date_diff(date_create(date('Y-m-d')), date_create($user_data->birthdate))->format('%y');  ?>
                                <?php echo isset($user_data->birthdate) ? $leeftijd : "Onbekend"; ?><br>
                                <strong>Rol</strong> <br>
                                <?php echo isset($user_data->role_name) ? $user_data->role_name : "Onbekend"; ?><br>
                                <strong>Geregistreerd</strong><br>
                                <?php echo isset($user_data->created_at) ? $user_data->created_at : "Onbekend"; ?><br>
                                <strong>Forum handtekening</strong><br>
                                <?php if($user_data->signature != "") : ?>
                                    <?php echo $user_data->signature; ?>
                                <?php else: ?>
                                    <span style="color: lightgray;">Geen handtekening</span>
                                <?php endif; ?><br>
                            </div>
                        </div>
                    </div>
                    <?php require ('../../includes/components/advertentie.php'); ?>

                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Statistieken</div>
                        <div class="panel-body text-left">

                            <?php
                                //Get number of topic from logged_in user
                                $topicSql = "SELECT COUNT(id) AS t FROM topic WHERE user_id = ?";
                                $topicResult = $dbc->prepare($topicSql);
                                $topicResult->bindParam(1, $user_data->id);
                                $topicResult->execute();
                                $x_topic = $topicResult->fetch(PDO::FETCH_OBJ);

                                //Get number of reply from logged_in user
                                $replySql = "SELECT COUNT(id) AS r FROM reply WHERE user_id = ?";
                                $replyResult = $dbc->prepare($replySql);
                                $replyResult->bindParam(1, $user_data->id);
                                $replyResult->execute();
                                $x_reply = $replyResult->fetch(PDO::FETCH_OBJ);

                                //Get number of album from logged_in user
                                $albumSql = "SELECT COUNT(id) AS a FROM album WHERE user_id = ?";
                                $albumResult = $dbc->prepare($albumSql);
                                $albumResult->bindParam(1, $user_data->id);
                                $albumResult->execute();
                                $x_album = $albumResult->fetch(PDO::FETCH_OBJ);

                                // Get number of album reply from logged_in user
                                $albumreplySql = "SELECT COUNT(id) AS ar FROM album_reply WHERE user_id = ?";
                                $albumreplyResult = $dbc->prepare($albumreplySql);
                                $albumreplyResult->bindParam(1, $user_data->id);
                                $albumreplyResult->execute();
                                $x_albumreply = $albumreplyResult->fetch(PDO::FETCH_OBJ);

                                //Get number of aquaria from logged_in user
                                $aquariumSql = "SELECT COUNT(id) AS a FROM aquarium WHERE user_id = ?";
                                $aquariumResult = $dbc->prepare($aquariumSql);
                                $aquariumResult->bindParam(1, $user_data->id);
                                $aquariumResult->execute();
                                $x_aquarium = $aquariumResult->fetch(PDO::FETCH_OBJ);

                                // Get number of aquaria reply from logged_in user
                                $aquariumreplySql = "SELECT COUNT(id) AS ar FROM aquarium_reply WHERE user_id = ?";
                                $aquariumreplyResult = $dbc->prepare($aquariumreplySql);
                                $aquariumreplyResult->bindParam(1, $user_data->id);
                                $aquariumreplyResult->execute();
                                $x_aquariumreply = $aquariumreplyResult->fetch(PDO::FETCH_OBJ);

                                // Get number of news from logged_in user
                                $newsSql = "SELECT COUNT(id) AS n FROM news WHERE id = ?";
                                $newsResult = $dbc->prepare($newsSql);
                                $newsResult->bindParam(1, $user_data->id);
                                $newsResult->execute();
                                $x_news = $newsResult->fetch(PDO::FETCH_OBJ);

                                // Get number of news reply from logged_in user
                                $newsreplySql = "SELECT COUNT(user_id) AS nr FROM news_reply WHERE user_id = ?";
                                $newsreplyResult = $dbc->prepare($newsreplySql);
                                $newsreplyResult->bindParam(1, $user_data->id);
                                $newsreplyResult->execute();
                                $x_newsreply = $newsreplyResult->fetch(PDO::FETCH_OBJ);

                                if ($x_topic->t > 1) {
                                    $x_topic->t = $x_topic->t.' topics';
                                } else {
                                    $x_topic->t = $x_topic->t.' topic';
                                }

                                if ($x_reply->r > 1) {
                                    $x_reply->r = $x_reply->r.' berichten';
                                } else {
                                    $x_reply->r = $x_reply->r.' bericht';
                                }

                                if ($x_album->a > 1) {
                                    $x_album->a = $x_album->a.' albums';
                                } else {
                                    $x_album->a = $x_album->a.' album';
                                }

                                if ($x_aquarium->a > 1) {
                                    $x_aquarium->a = $x_aquarium->a.' aquaria';
                                } else {
                                    $x_aquarium->a = $x_aquarium->a.' aquarium';
                                }

                                if ($x_albumreply->ar > 1) {
                                    $x_albumreply->ar = $x_albumreply->ar.' berichten';
                                } else {
                                    $x_albumreply->ar = $x_albumreply->ar.' bericht';
                                }

                                if ($x_aquariumreply->ar > 1) {
                                    $x_aquariumreply->ar = $x_aquariumreply->ar.' berichten';
                                } else {
                                    $x_aquariumreply->ar = $x_aquariumreply->ar.' bericht';
                                }

                                if ($x_news->n > 1) {
                                    $x_news->n = $x_news->n.' berichten';
                                } else {
                                    $x_news->n = $x_news->n.' bericht';
                                }

                                if ($x_newsreply->nr > 1) {
                                    $x_newsreply->nr = $x_newsreply->nr.' berichten';
                                } else {
                                    $x_newsreply->nr = $x_newsreply->nr.' bericht';
                                }

                                ?>
                                <strong>Aantal forum topics</strong><br>
                                <?php if ($x_topic->t == 0) {
                                    echo 'Geen forum topics';
                                } else {
                                    echo $x_topic->t;
                                } ?><br>

                                <strong>Aantal forum berichten</strong><br>
                                <?php if ($x_reply->r == 0) {
                                    echo 'Geen forum berichten';
                                } else {
                                    echo $x_reply->r;
                                } ?><br>

                                <strong>Aantal albums </strong><br>
                                <?php if ($x_album->a == 0) {
                                    echo 'Geen albums';
                                } else {
                                    echo $x_album->a;
                                } ?><br>

                                <strong>Aantal album reacties</strong><br>
                                <?php if ($x_albumreply->ar == 0) {
                                    echo 'Geen album reacties';
                                } else {
                                    echo $x_albumreply->ar;
                                } ?><br>

                                <strong>Aantal aquaria </strong><br>
                                <?php if ($x_aquarium->a == 0) {
                                    echo 'Geen aquaria';
                                } else {
                                    echo $x_aquarium->a;
                                } ?><br>

                                <strong>Aantal aquarium reacties</strong><br>
                                <?php if ($x_aquariumreply->ar == 0) {
                                    echo 'Geen aquarium reacties';
                                } else {
                                    echo $x_aquariumreply->ar;
                                } ?><br>

                                <strong>Aantal nieuws reacties</strong><br>
                                <?php if ($x_newsreply->nr == 0) {
                                    echo 'Geen nieuws reacties';
                                } else {
                                    echo $x_newsreply->nr;
                                } ?><br>

                        </div>
                    </div>
            </div>
            <div class="col-md-8">

                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Laatste activiteit op het forum</div>
                        <div class="panel-body text-right paddingNone">

                            <table>
                                <tr class="border-color-black">
                                    <th class="col-md-4 col-xs-4">Topic</th>
                                    <th class="col-md-4 col-xs-4">Forum</th>
                                    <th class="col-md-4 col-xs-4">Datum</th>
                                    <?php
                                        $sql = "SELECT *, r.last_changed AS reply_last_changed, t.last_changed AS topic_last_changed, t.created_at AS topic_created_at, r.created_at AS reply_created_at, r.user_id AS reply_user_id, t.user_id AS topic_user_id, u.first_name AS reply_first_name, u.last_name AS reply_last_name, u2.first_name AS topic_first_name, u2.last_name AS topic_last_name, sc.name AS sub_cat_name, t.id AS topic_id FROM topic AS t JOIN topic_permission AS tp ON tp.topic_id = t.id LEFT JOIN reply AS r ON r.topic_id = t.id LEFT JOIN user AS u ON u.id = r.user_id LEFT JOIN user AS u2 ON u2.id = t.user_id LEFT JOIN sub_category AS sc ON sc.id = t.sub_category_id WHERE (t.user_id = :id OR r.user_id = :id) AND tp.role_id = :role_id AND t.deleted_at IS NULL ORDER BY reply_created_at DESC, topic_created_at DESC LIMIT 9";
                                        $result = $dbc->prepare($sql);
                                        $result->execute([":id" => $user_data->id, ":role_id" => $user_data->role_id]);
                                        $topics = $result->fetchAll(PDO::FETCH_OBJ);

                                    if(!empty($topics)) :
                                        foreach ($topics as $key => $value) : ?>
                                            <tr>
                                                <td class="col-md-4 col-xs-4"><a href="/forum/post/<?php echo $value->topic_id; ?>"><?php echo $value->title; ?></a></td>
                                                <td class="col-md-4 col-xs-4"><a href="/forum/topic/<?php echo $value->sub_category_id; ?>"><?php echo $value->sub_cat_name; ?></a></td>
                                                <td class="col-md-4 col-xs-4"><?php echo isset($value->reply_created_at) ? $value->reply_created_at : $value->topic_created_at; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td>Geen reacties op topics gevonden</td>
                                        </tr>
                                    <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Albums</div>
                        <div class="panel-body">
                            <?php
                                $albumSql = "SELECT *, album.id AS album_id FROM album JOIN image ON album.id = image.album_id WHERE album.user_id = ? GROUP BY album.id ORDER BY created_at DESC LIMIT 8";
                                $albumResult = $dbc->prepare($albumSql);
                                $albumResult->bindParam(1, $user_data->id);
                                $albumResult->execute();
                                $albums = $albumResult->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(!empty($albums)) : ?>
                                <?php foreach($albums as $album): ?>
                                    <a href="/album/post/<?php echo $album['album_id']; ?>"><img alt="Album-img" src="/images<?php echo $album['path']; ?>" alt="<?php echo $album['title']; ?>" class="img padding"></a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                Geen albums gevonden
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Aquariums</div>
                        <div class="panel-body">
                            <?php
                                $aquariumSql = "SELECT *, aquarium.id AS aquarium_id FROM aquarium JOIN image ON aquarium.id = image.aquarium_id WHERE aquarium.user_id = ? GROUP BY image.aquarium_id ORDER BY created_at DESC LIMIT 8";
                                $aquariumResult = $dbc->prepare($aquariumSql);
                                $aquariumResult->bindParam(1, $user_data->id);
                                $aquariumResult->execute();
                                $aquariums = $aquariumResult->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <?php if(!empty($aquariums)) : ?>
                                <?php foreach($aquariums as $aquarium): ?>
                                    <a href="/aquarium/post/<?php echo $aquarium['aquarium_id']; ?>"><img alt="Aquarium-img" src="/images<?php echo $aquarium['path']; ?>" alt="<?php echo $aquarium['title']; ?>" class="img padding"></a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                Geen aquariums gevonden
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
            <div class="col-md-12"></div>

        </div>
        <div class="col-md-8">

        </div>
        </div>

        <div class="conainter-fluid"></div>
        <footer>
            <?php require_once("../../includes/components/footer.php") ; ?>
        </footer>
        <!-- bootstrap script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>

    </html>
    <!-- https://twitter.com/DiscusHolland -->
