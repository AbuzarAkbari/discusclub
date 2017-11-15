<?php $levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");


if (isset($_POST['post_reply'])) {
    require_once("../../includes/tools/security.php");
    if ($logged_in) {
        $reply_content = $_POST['reply_content'];
        $bericht_id = $_POST['bericht_id'];
        $reply_auteur = $_SESSION['user']->id;
        $sql3 = "INSERT INTO news_reply (news_id, user_id, content, created_at) VALUES (:bericht_id, :reply_auteur, :reply_content, NOW())";

        $sql = "UPDATE news SET last_changed = NOW() WHERE id = :bericht_id";
        $result = $dbc->prepare($sql);
        $result->bindParam(':bericht_id', $bericht_id);
        $result->execute();


        $result3 = $dbc->prepare($sql3);
        $result3->bindParam(':bericht_id', $bericht_id);
        $result3->bindParam(':reply_auteur', $reply_auteur);
        $result3->bindParam(':reply_content', $reply_content);
        $result3->execute();
        header("Location: /news/post/" . $bericht_id . "#post-" . $dbc->lastInsertId());
    }
}

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$perPage = 10;
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
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php
require_once("../../includes/components/nav.php");
?>


<div class="container main" style="margin-top:25px;">

    <div class="row">
        <div class="col-md-12">
            <?php
            $sql = "SELECT * FROM news WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_GET['id']);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            if($rows){
                $subcat_id = $rows[0]['sub_category_id'];
                $subSql = "SELECT * FROM sub_category WHERE id = ?";
                $subResult = $dbc->prepare($subSql);
                $subResult->bindParam(1, $subcat_id);
                $subResult->execute();
                $subId = $subResult->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            <?php if($rows) : ?>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/news">Nieuws</a></li>
                    <li class="active"><?php echo $rows[0]['title']; ?></li>
                </ol>
            <?php endif; ?>
            <?php if(!$rows) : ?>
                <div class="message error">Deze pagina bestaat niet, <a href="/about/news"> ga terug</a></div></div>
            <?php else : ?>
            <?php foreach ($rows as $row) : ?>
            <?php if($_GET['pagina'] == 1) :?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-left"><?php echo $row['title']; ?></h3>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-10 content">
                            <p><?php echo $row['content']; ?></p>
                        </div>
                    </div>

                </div>

                <div class="panel-footer">
                    op <?php echo $row['created_at']; ?></h3>
                </div>
            </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>



            <?php
                $a = $page * $perPage - $perPage;
                $replySql = "SELECT *, user.created_at AS user_created_at, news_reply.created_at AS reply_created_at, news_reply.content AS news_reply_content FROM news_reply JOIN news ON news_reply.news_id = news.id JOIN user ON news_reply.user_id = user.id JOIN role ON user.role_id = role.id JOIN image ON user.profile_img = image.id WHERE news.id = :id AND news_reply.deleted_at IS NULL ORDER BY news_reply.last_changed ASC LIMIT {$perPage} OFFSET {$a}";
                $replyResult = $dbc->prepare($replySql);
                $replyResult->execute([":id" => $_GET['id']]);
                $replies = $replyResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($replies as $reply) : ?>
                <?php

                $matches = [
                    [],
                    [1]
                ];

                while ($matches[1]) {
                    preg_match_all('/\[quote\s(\d+)\]/', $reply['news_reply_content'], $matches);

                    foreach ($matches[1] as $match) {
                        $sql = "SELECT * FROM news_reply WHERE id = :id";
                        $query = $dbc->prepare($sql);
                        $query->execute([
                            ':id' => $match
                        ]);
                        $results = $query->fetchAll();

                        $id = $rows[0]['user_id'];

//                        echo '<pre>';
//                        print_r($rows[0]['user_id']);
//                        exit;

                        $userIdSql = "SELECT * FROM user WHERE id = ?";
                        $userIdResult = $dbc->prepare($userIdSql);
                        $userIdResult->bindParam(1, $id);
                        $userIdResult->execute();
                        $userId = $userIdResult->fetchAll(PDO::FETCH_ASSOC);

                        if (!isset($results[0])) {
                            $replace = 'Oops, deze post bestaat niet meer';
                        } else {
                            $naam = $userId[0]['first_name'].' '.$userId[0]['last_name'];
                            $replace = $naam.' schreef:<br>'.$results[0]['content'];
                        }

                        $reply['content'] = str_replace('[quote ' . $match . ']', '<div style="background-color: lightgray; padding: 10px;border:1px solid black">'.$replace.'</div>', $reply['content']);
                    }
                }


                $userSql = "SELECT * FROM user JOIN image ON user.profile_img = image.id WHERE user.id = ?";
                $userResult = $dbc->prepare($userSql);
                $userResult->bindParam(1, $row2['user_id']);
                $userResult->execute();
                $user = $userResult->fetch(PDO::FETCH_ASSOC);

                $replySql = "SELECT COUNT(id) AS x_reply FROM news_reply WHERE user_id = ? AND deleted_at IS NULL";
                $replyResult = $dbc->prepare($replySql);
                $replyResult->bindParam(1, $reply['user_id']);
                $replyResult->execute();
                $replyCount = $replyResult->fetch(PDO::FETCH_ASSOC);
                ?>
                 <div class="panel panel-primary" id="post-<?php echo $reply['id'] ?>">
                    <div class="panel-body">
                        <div class="wrapper-box col-md-12">
                            <div class="col-md-3">
                            <div class="col-md-12">
                                <img alt="Profielfoto" class="img" src="/images<?php echo $reply['path']; ?>">
                            </div>
                            <div class="col-md-12">
                                <br><b>Rol: </b><?php echo $reply['name']; ?>
                                <br><b>Aantal berichten: </b><?php echo $replyCount['x_reply']; ?>
                                <br><b>Lid sinds: </b> <?php echo $reply['user_created_at']; ?><br><br>
                            </div>
                            </div>

                            <div class="col-md-9 content">
                                 <p><?php echo $reply['news_reply_content']; ?></p>
                            </div>

                </div>

            </div>
            <div class="panel-footer">
                <?php
                    $userSql = "SELECT * FROM user WHERE id = ?";
                    $userResult = $dbc->prepare($userSql);
                    $userResult->bindParam(1, $reply['user_id']);
                    $userResult->execute();
                    $users = $userResult->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($users as $user) : ?>
                    <b>Geplaatst door:</b> <i><a href="/user/<?php echo $reply['user_id']; ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></i>
                <?php endforeach; ?>
                op <?php echo $reply['reply_created_at']; ?></h3>

                <div class="pull-right">

                    <button class="btn btn-primary quote-btn" data-id="<?php echo $reply['id']; ?>">
                        Quote deze post
                    </button>
                </div>

                <div class="clearfix"></div>
            </div>

     </div>
            <?php endforeach; ?>
            <?php
            $path = "/news/post/".$_GET["id"]."/:page";
            $sql = "SELECT COUNT(*) AS x FROM news_reply WHERE news_id = :id";
            $pagination_bindings = [":id" => $_GET["id"]];
            require_once("../../includes/components/pagination.php");
            ?>
        </div>
    <?php if ($logged_in && $rows) : ?>
    <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Antwoord toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                            <textarea required class="form-control editor" col="8" rows="8" name="reply_content"
                                      style="resize: none;" placeholder="Uw bericht.."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="hidden" name="bericht_id" value="<?php echo $_GET['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" class="form-control" name="post_reply"
                                       value="Plaats reactie">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php require ('../../includes/components/advertentie.php'); ?>

    </div>
</div>

<footer>
    <?php require_once("../../includes/components/footer.php"); ?>
</footer>
<!-- bootstrap script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- summernote js -->
<script type="text/javascript" src="/js/summernote.min.js"></script>
<script>
    $('.editor').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $(document).ready(function () {
        $('.quote-btn').on('click', function () {
            $('.editor').summernote('insertText', '[quote '+($(this).attr('data-id'))+']')//.disabled = true
        });
    });
</script>
</body>

</html>
