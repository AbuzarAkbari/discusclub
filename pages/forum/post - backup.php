<?php
    //Levels var
    $levels = ["lid"];

    //Security
    require_once("../../includes/tools/security.php");

    //Pagination variables
    $page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $perPage = 10;

    //Select query for sub_category, topics, users, replies and roles
    $sql = "SELECT *, reply.id as reply_id, reply.content AS reply_content, user.id AS user_id, role.name AS role_name, user.created_at AS user_created_at, topic.id as topic_id, topic.created_at AS topic_created_at, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name FROM topic JOIN sub_category ON topic.sub_category_id = sub_category.id JOIN user ON topic.user_id = user.id JOIN image ON user.profile_img = image.id JOIN role ON user.role_id = role.id JOIN reply ON topic.id = reply.topic_id WHERE topic.id = ?";
    $result = $dbc->prepare($sql);
    $result->bindParam(1, $_GET['id']);
    $result->execute();
    $rows = $result->fetchAll(PDO::FETCH_ASSOC)[0];

    $fullName = $rows['first_name'].' '.$rows['last_name'];

    //Antwoord toevoegen
    require_once("../../includes/tools/berichtParse.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bericht.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- summernote css -->
    <link rel="stylesheet" href="/css/summernote.css">
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

    <!-- Start topic -->
    <div class="row">
        <div class="col-xs-12">
            <?php if(!$rows) : ?>
                <div class="message error">Deze pagina bestaat niet, <a href="/forum/"> ga terug</a></div>
            <?php else : ?>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/forum/">Forum</a></li>
                    <li><a href="/forum/topic/<?php echo $rows['sub_category_id']; ?>"><?php echo $rows['sub_category_name']; ?></a></li>
                    <li class="active"><?php echo $rows['title']; ?></li>
                </ol>

                <div class="panel panel-primary">
                    <div class="panel-heading border-color-blue">
                        <h3 class="panel-title text-left"><?php echo $rows['title']; ?></h3>
                    </div>

                    <div class="panel-body padding-padding ">
                        <div class="col-md-12 ">
                            <div class="col-md-3">
                                <div class="col-md-12">
                                    <img class="img" src="/images<?php echo $rows['path']; ?>">
                                </div>
                                <?php
                                    $replySql = "SELECT COUNT(id) AS x_reply FROM reply WHERE user_id = ? AND deleted_at IS NULL";
                                    $replyResult = $dbc->prepare($replySql);
                                    $replyResult->bindParam(1, $_SESSION['user']->id);
                                    $replyResult->execute();
                                    $replyCount = $replyResult->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="col-md-12">
                                    <br><b>Rol: </b><?php echo $rows['role_name']; ?>
                                    <br><b>Aantal berichten: </b><?php echo $replyCount['x_reply']; ?>
                                    <br><b>Lid sinds: </b> <?php echo $rows['user_created_at']; ?><br><br>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p><?php echo html_entity_decode($rows['content']); ?></p>
                                <p>
                                    <hr>
                                    <br>
                                    <?php echo $rows['signature']; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <b>Geplaatst door: </b>
                        <a href="/user/<?php echo $rows['user_id']; ?>"><?php echo $fullName; ?></a>
                        op
                        <?php echo $rows['topic_created_at']; ?>
                        <div class="text-right">
                            <?php //if() : ?>
                                <i class="glyphicon glyphicon-star-empty GlyphSize "></i>
                            <?php //else : ?>
                                <i class="glyphicon glyphicon-star GlyphSize "></i>
                            <?php //endif; ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- Quoting system -->

    <?php
        $aantal = $page * $perPage - $perPage;
        $replySql = "SELECT * FROM reply WHERE topic_id = ? AND reply.deleted_at IS NULL LIMIT {$perPage} OFFSET {$aantal}";
        $replyResult = $dbc->prepare($replySql);
        $replyResult->bindParam(1, $_GET['id']);
        $replyResult->execute();
        $replies = $replyResult->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach ($replies as $reply) : ?>
        <?php

        $matches = [
            [],
            [1]
        ];

        while ($matches[1]) {
            preg_match_all('/\[quote\s(\d+)\]/', $rows['reply_content'], $matches);

            foreach ($matches[1] as $match) {
                $sql = "SELECT * FROM reply WHERE id = :id AND reply.deleted_at IS NULL";
                $query = $dbc->prepare($sql);
                $query->execute([
                    ':id' => $match
                ]);
                $results = $query->fetchAll();

                $id = $rows[0]['user_id'];

                $userIdSql = "SELECT * FROM user WHERE id = ? AND user.deleted_at IS NULL";
                $userIdResult = $dbc->prepare($userIdSql);
                $userIdResult->bindParam(1, $id);
                $userIdResult->execute();
                $userId = $userIdResult->fetchAll(PDO::FETCH_ASSOC);

                if (!isset($results[0])) {
                    $replace = 'Oops, deze post bestaat niet meer';
                } else {
                    $naam = $userId[0]['first_name'] . ' ' . $userId[0]['last_name'];
                    $replace = $naam . ' schreef:<br>' . $results[0]['content'];
                }

                $row2['content'] = str_replace('[quote ' . $match . ']', '<div style="background-color: lightgray; padding: 10px;border:1px solid black">' . $replace . '</div>', $row2['content']);
            }
        }


        ?>

        <!-- Replies -->
        <div class="col-xs-12">
            <div class="panel panel-primary" id="post-<?php echo $rows['reply_id'] ?>">
                <div class="panel-heading border-color-blue">
                    <h3 class="panel-title text-left">Geplaatst door: <b><a
                                style="color: #fff; text-decoration: underline"
                                href="/user/<?php echo $rows["user_id"]; ?>"><?php echo $fullName; ?></a></b>
                    </h3>
                    <?php if (in_array($current_level, $admin_levels)) : ?>
                        <span style="float: right; margin-top: -23px;"><a title="Verwijderen" href="/admin/tools/del.php?id=<?php echo $rows['topic_id']; ?>" type="button" class="btn" name="button" style="color: #fff;"> <i class="glyphicon glyphicon-remove-sign" ></i></a></span>
                    <?php endif; ?>
                </div>
                <div class="panel-body padding-padding ">
                    <div class="wrapper-box col-xs-12">
                        <div class="col-md-2">
                            <img src='http://via.placeholder.com/130x130' alt="x">
                        </div>

                        <div class="col-md-10">
                            <p><?php echo wordwrap($rows['reply_content'], 70, "<br>", true); ?></p>
                        </div>

                    </div>
                </div>
                <div class="panel-footer">
                    <b>Geplaatst op </b><?php echo $rows['created_at']; ?>

                    <div class="pull-right">

                        <button class="btn btn-primary quote-btn" data-id="<?php echo $rows['id']; ?>">
                            Quote deze post
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    <?php endforeach; ?>


    <!-- Pagination system -->
    <div class="col-xs-12">

        <?php

        $query = $dbc->prepare('SELECT COUNT(*) AS x FROM reply WHERE topic_id = :id AND reply.deleted_at IS NULL');
        $query->execute([
            ':id' => $_GET['id']
        ]);
        $results = $query->fetchAll()[0];
        $count = ceil($results['x'] / $perPage);
        ?>

        <?php if ($results['x'] > $perPage) : ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($x = ($count - 4 < 1 ? 1 : $count - 4); $x < ($count + 1); $x++) : ?>
                        <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>><a
                                href="/forum/post/<?php echo $rows[0]['topic_id']; ?>/<?php echo $x; ?>"><?php echo $x; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <?php if ($logged_in) : ?>

    <!-- Add reply -->
    <div class="col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Antwoord toevoegen</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="reply_content"
                                          style="resize: none;" maxlength="50" placeholder="Uw bericht.."></textarea>
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
    <?php endif; ?>
</div>
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
        disableResizeEditor: true,
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
            $('.editor').summernote('insertText', '[quote ' + ($(this).attr('data-id')) + ']')//.disabled = true
        });
    });
</script>
</body>

</html>