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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="/favicon.ico" />
        <title>Discusclub Holland</title>

        <!-- custom css -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/gebruiker.css">
        <!-- font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- bootstrap style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <div class="container">
        <div class="">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Gebruiker</li>
            </ol>
        </div>
        </div>
        <div class="container main">
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

                <div class="col-md-12">
                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue"><?php echo $user_data->first_name.' '.$user_data->last_name; ?></div>
                        <div class="panel-body text-left">
                            <div class="text-center">
                                <div style="background-image:url('/images/profiel/<?php echo isset($user_data->profile_img) ? $user_data->profile_img : " "; ?>')"; class="img "></div>
                            </div>
                            <div class="col-md-12">
                                <strong>Locatie</strong><br>
                                <?php echo isset($user_data->city) ? $user_data->city : "Onbekend"; ?><br>
                                <strong>Leeftijd</strong><br>
                                <?php $leeftijd = date_diff(date_create(date('Y-m-d')), date_create($user_data->birthdate))->format('%y');  ?>
                                <?php echo isset($user_data->birthdate) ? $leeftijd : "Onbekend"; ?><br>
                                <strong>Rol</strong> <br>
                                <?php echo isset($user_data->role_name) ? $user_data->role_name : "Onbekend"; ?><br>
                                <strong>Geregistreerd</strong><br>
                                <?php echo isset($user_data->created_at) ? $user_data->created_at : "Onbekend"; ?><br>
                                <strong>Forum handtekening</strong><br>
                                <?php echo isset($user_data->signature) ? $user_data->signature : ""; ?><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
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
                                ?>
                                <strong>Aantal forum topics</strong><br>
                                <?php if ($x_topic->t == 0) {
                                    echo 'Geen topics';
                                } else {
                                    echo $x_topic->t;
                                } ?><br>
                                <strong>Aantal forum berichten</strong><br>
                                <?php if ($x_reply->r == 0) {
                                    echo 'Geen berichten';
                                } else {
                                    echo $x_reply->r;
                                } ?><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="col-md-12">
                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Laatste reacties op topics</div>
                        <div class="panel-body text-right paddingNone">

                            <table>
                                <tr class="border-color-black">
                                    <th class="col-md-4 col-xs-4">Topic</th>
                                    <th class="col-md-4 col-xs-4">Forum</th>
                                    <th class="col-md-4 col-xs-4">Datum</th>
                                    <?php
                                        $sql = "SELECT *, topic.id AS topic_id, sub_category.id AS sub_category_id, reply.created_at AS reply_created_at, topic.created_at as topic_created_at FROM topic LEFT JOIN sub_category ON topic.sub_category_id = sub_category.id LEFT JOIN reply ON topic.id = reply.topic_id WHERE reply.user_id = :id OR topic.user_id = :id ORDER BY reply_created_at DESC, topic_created_at DESC LIMIT 10";
                                        $result = $dbc->prepare($sql);
                                        $result->bindParam(":id", $user_data->id);
                                        $result->execute();
                                        $topics = $result->fetchAll(PDO::FETCH_OBJ);
                                    ?>
                                    <?php foreach($topics as $info) : ?>
                                        <tr>
                                            <td class="col-md-4 col-xs-4"><a href="/forum/post/<?php echo $info->topic_id; ?>"><?php echo $info->title; ?></a></td>
                                            <td class="col-md-4 col-xs-4"><a href="/forum/topic/<?php echo $info->sub_category_id; ?>"><?php echo $info->name; ?></a></td>
                                            <td class="col-md-4 col-xs-4">
                                                <?php echo isset($info->reply_created_at) ? $info->reply_created_at : $info->topic_created_at; ?>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-primary border-color-blues">
                        <div class="panel-heading border-color-blue">Albums</div>
                        <div class="panel-body text-left">
                            <?php
                    $albumSql = "SELECT *, album.id AS album_id FROM album JOIN image ON album.id = image.album_id WHERE album.user_id = ? ORDER BY created_at LIMIT 10";
                    $albumResult = $dbc->prepare($albumSql);
                    $albumResult->bindParam(1, $user_data->id);
                    $albumResult->execute();
                    $albums = $albumResult->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                            <?php foreach($albums as $album): ?>
                                <a href="/album/<?php echo $album['album_id']; ?>"><img src="/images/album/<?php echo $album['path']; ?>" alt="<?php echo $album['title']; ?>" height="150" width="150"></a>
                            <?php endforeach; ?>
                        </div>
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
