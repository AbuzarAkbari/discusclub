<?php
//Levels var
$levels = ["lid", "gebruiker"];

//Security
require_once("../../includes/tools/security.php");

//Pagination variables
$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
if (false === intval($page)) {
    exit;
}
$perPage = 10;

//Select query for sub_category, topics, users, replies and roles
$sql = "SELECT *, user.id AS user_id, role.name AS role_name, user.created_at AS user_created_at, topic.id as topic_id, topic.content AS topic_content, topic.created_at AS topic_created_at, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name FROM topic LEFT JOIN sub_category ON topic.sub_category_id = sub_category.id LEFT JOIN user ON topic.user_id = user.id LEFT JOIN image ON user.profile_img = image.id LEFT JOIN role ON user.role_id = role.id WHERE topic.id = ?";
$result = $dbc->prepare($sql);
$result->bindParam(1, $_GET['id']);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);

$fullName = $rows['first_name'].' '.$rows['last_name'];

if($rows) {

    $subcat_id = $rows['sub_category_id'];
    $subSql = "SELECT * FROM sub_category WHERE id = ?";
    $subResult = $dbc->prepare($subSql);
    $subResult->bindParam(1, $subcat_id);
    $subResult->execute();
    $subId = $subResult->fetchAll(PDO::FETCH_ASSOC);

    $sql = "INSERT INTO view (topic_id, ip_id, created_at) VALUES (:id, :ip_id, NOW())";
    $result = $dbc->prepare($sql);
    $result->execute([":id" => $_GET["id"], ":ip_id" => $_SESSION["ip_id"]]);

}

//Antwoord toevoegen
require_once("../../includes/tools/berichtParse.php");
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

            <?php if($_GET['pagina'] == 1) : ?>
            <div class="panel panel-primary">
                <div class="panel-heading border-color-blue">
                    <h3 class="panel-title text-left"><?php echo $rows['title']; ?></h3>
                </div>

                <div class="panel-body padding-padding ">
                    <div class="col-md-12 ">
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <img alt="profielfoto" class="img" src="/images<?php echo $rows['path']; ?>">
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
                            <p><?php echo $rows["topic_content"]; ?></p>
                            <p>
                            <hr>
                            <?php if($rows['signature'] != "") : ?>
                                <?php echo $rows['signature']; ?>
                            <?php else: ?>
                                <span style="color: lightgray;">Geen handtekening</span>
                            <?php endif; ?>
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
                        <?php
                        $sth = $dbc->prepare("SELECT * FROM favorite WHERE user_id = :user_id AND topic_id = :topic_id");
                        $sth->execute([":user_id" => $_SESSION["user"]->id, "topic_id" => $_GET["id"]]);
                        $favorite = $sth->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <?php if($favorite) : ?>
                            <a href="/includes/tools/user-un-favorite?id=<?php echo $_GET['id']; ?>" class="glyphicon glyphicon-star GlyphSize " style="text-decoration: none; color: gold;"></a>
                        <?php else :?>
                            <a href="/includes/tools/user-favorite?id=<?php echo $_GET['id']; ?>" class="glyphicon glyphicon-star-empty GlyphSize " style="text-decoration: none; color: gold;"></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quoting system -->

    <?php
    $aantal = $page * $perPage - $perPage;
    $replySql = "SELECT *, image.path AS image_path, u.id AS user_id, u.created_at AS user_created_at, reply.id, reply.last_changed, reply.created_at FROM reply JOIN user as u ON u.id = reply.user_id JOIN role ON u.role_id = role.id JOIN image ON u.profile_img = image.id WHERE topic_id = ? AND reply.deleted_at IS NULL ORDER BY reply.last_changed ASC LIMIT {$perPage} OFFSET {$aantal}";
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
            preg_match_all('/\[quote\s(\d+)\]/', $reply['content'], $matches);

            foreach ($matches[1] as $match) {
                $sql = "SELECT *, reply.id FROM reply JOIN user as u ON u.id = reply.user_id WHERE reply.id = :id AND reply.deleted_at IS NULL";
                $query = $dbc->prepare($sql);
                $query->execute([
                    ':id' => $match
                ]);
                $results = $query->fetch(PDO::FETCH_ASSOC);

                $naam = $results["first_name"] . " " . $results["last_name"];

                if (!isset($results)) {
                    $replace = 'Oops, deze post bestaat niet meer';
                } else {
                    $replace = $naam . ' schreef:<br>' . $results['content'];
                }

                $reply['content'] = str_replace('[quote ' . $match . ']', '<div style="background-color: lightgray; padding: 10px;border:1px solid black">' . $replace . '</div>', $reply['content']);
            }
        }
        $naam = $reply["first_name"] . " " . $reply["last_name"];
        ?>

        <!-- Replies -->
        <div class="col-xs-12">
            <div class="panel panel-primary" id="post-<?php echo $reply['id']; ?>">
                <div class="panel-heading border-color-blue">
                    <h3 class="panel-title text-left">Geplaatst door: <b><a
                                    style="color: #fff; text-decoration: underline"
                                    href="/user/<?php echo $reply["user_id"]; ?>"><?php echo $naam; ?></a></b>
                    </h3>
                    <?php if (in_array($current_level, $admin_levels)) : ?>
                        <span style="float: right; margin-top: -23px;"><a title="Verwijderen" href="/includes/tools/reply/del.php?topic_id=<?php echo $_GET["id"]; ?>&id=<?php echo $reply['id']; ?>" class=" btn-primary"  style="color: #fff; background-color: #0ba8ec;"> <i class="glyphicon glyphicon-remove-sign" ></i></a></span>
                    <?php endif; ?>
                </div>
                <div class="panel-body padding-padding ">
                    <div class="wrapper-box col-xs-12">
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <img alt='profielfoto' class="img" src="/images<?php echo $reply['image_path']; ?>">
                            </div>
                            <?php
                                $replySql = "SELECT COUNT(id) AS x_reply FROM reply WHERE user_id = ? AND deleted_at IS NULL";
                                $replyResult = $dbc->prepare($replySql);
                                $replyResult->bindParam(1, $reply['user_id']);
                                $replyResult->execute();
                                $replyCount = $replyResult->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="col-md-12">
                                <br><b>Rol: </b><?php echo $reply['name']; ?>
                                <br><b>Aantal berichten: </b><?php echo $replyCount['x_reply']; ?>
                                <br><b>Lid sinds: </b> <?php echo $reply['user_created_at']; ?><br><br>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <p><?php echo $reply["content"]; ?></p>
                            <p>
                                <hr>
                                <?php if($reply['signature'] != "") : ?>
                                <?php echo $reply['signature']; ?>
                                <?php else: ?>
                                    <span style="color: lightgray;">Geen handtekening</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <b>Geplaatst op </b><?php echo $reply['last_changed']; ?>

                    <div class="pull-right">

                        <button class="btn btn-primary quote-btn" data-id="<?php echo $reply['id']; ?>">
                            Quote deze post
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    <?php endforeach; ?>


    <?php
    $path = "/forum/post/".$_GET["id"]."/:page";
    $sql = "SELECT COUNT(*) AS x FROM reply WHERE topic_id = :id AND reply.deleted_at IS NULL";
    $pagination_bindings = [":id" => $_GET["id"]];
    require_once("../../includes/components/pagination.php");
    ?>

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
                                <textarea required class="form-control editor" col="8" rows="8" name="reply_content" style="resize: none;" maxlength="50" placeholder="Uw bericht.."></textarea>
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
<?php
// $ad_in_row = true;
require_once('../../includes/components/advertentie.php'); ?>
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
<script src="/js/summernote-ext-emoji.js" charset="utf-8"></script>
<script>
    document.emojiSource = '/images/emoji/';
    $('.editor').summernote({
        disableResizeEditor: true,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['misc', ['emoji']],
            ['code', ['codeview']]
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
