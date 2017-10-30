<?php
$levels = ["lid"];
require_once("../../includes/tools/security.php");

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$sql = "INSERT INTO view (topic_id, ip_id) VALUES (:id, :ip_id)";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["id"], ":ip_id" => $_SESSION["ip_id"]]);

$page = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$perPage = 10;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- summernote css -->
    <link rel="stylesheet" href="/css/summernote.css">
    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
<div id="fb-root"></div>
<script>
    ;(function (d, s, id) {
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
require_once("../../includes/components/nav.php");
?>

<div class="container main">
    <div class="row">

        <div class="col-xs-12">
            <br><br>
            <?php
            $sql = "SELECT * FROM topic WHERE id = ?";
            $result = $dbc->prepare($sql);
            $result->bindParam(1, $_GET['id']);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            $subcat_id = $rows[0]['sub_category_id'];
            $subSql = "SELECT * FROM sub_category WHERE id = ?";
            $subResult = $dbc->prepare($subSql);
            $subResult->bindParam(1, $subcat_id);
            $subResult->execute();
            $subId = $subResult->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/">Forum</a></li>
                <li><a href="/"><?php echo $subId[0]['name']; ?></a></li>
                <li class="active"><?php echo $rows[0]['title']; ?></li>
            </ol>
            <?php foreach ($rows as $row) : ?>
            <div class="panel panel-primary ">
                <div class="panel-heading border-color-blue">
                    <h3><?php echo $row['title']; ?></h3>

                </div>
                <div class="panel-body padding-padding table-responsive">
                    <div class="col-md-12 verticalLine">
                        <div class="">
                            <br>
                            <?php echo html_entity_decode($row['content']); ?>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <?php
                        $userSql = "SELECT * FROM user WHERE id = ?";
                        $userResult = $dbc->prepare($userSql);
                        $userResult->bindParam(1, $row['user_id']);
                        $userResult->execute();
                        $users = $userResult->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($users as $user) : ?>
                            <b>Geplaatst door:</b> <i><a href="/user/<?php echo $user["id"]; ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></i>
                        <?php endforeach; ?>
                        op <?php echo $row['created_at']; ?></h3>
                        <div class="text-right">
                            <i class="glyphicon glyphicon-star-empty GlyphSize "></i>
                            <i class="glyphicon glyphicon-star GlyphSize "></i>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>

            </div>
            <br>
        </div>
    </div>
</div>
<?php
$a = $page * $perPage - $perPage;
$sql2 = "SELECT * FROM reply WHERE topic_id = ? LIMIT {$perPage} OFFSET {$a}";
$result2 = $dbc->prepare($sql2);
$result2->bindParam(1, $_GET['id']);
$result2->execute();
$rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($rows2 as $row2) : ?>
<?php

$matches = [
    [],
    [1]
];

while ($matches[1]) {
    preg_match_all('/\[quote\s(\d+)\]/', $row2['content'], $matches);

    foreach ($matches[1] as $match) {
        $sql = "SELECT * FROM reply WHERE id = :id";
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

        $row2['content'] = str_replace('[quote ' . $match . ']', '<div style="background-color: lightgray; padding: 10px;border:1px solid black">'.$replace.'</div>', $row2['content']);
    }
}



?>
<div class="container main">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary" id="post-<?php echo $row2['id'] ?>">

                <div class="panel-body padding-padding table-responsive">
                    <div class="col-md-12 ">
                        <?php echo $row2['content']; ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php
                    $userSql = "SELECT * FROM user WHERE id = ?";
                    $userResult = $dbc->prepare($userSql);
                    $userResult->bindParam(1, $row2['user_id']);
                    $userResult->execute();
                    $users = $userResult->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($users as $user) : ?>
                        <b>Geplaatst door:</b> <i><a href="#"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></i>
                    <?php endforeach; ?>
                    op <?php echo $row2['created_at']; ?></h3>

                    <div class="pull-right">

                        <button class="btn btn-primary quote-btn" data-id="<?php echo $row2['id']; ?>">
                            Quote deze post
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>

                </div>
            <?php endforeach; ?>
            <br>
        <div class="col-xs-12">
            <?php

            $query = $dbc->prepare('SELECT COUNT(*) AS x FROM reply WHERE topic_id = :id');
            $query->execute([
                ':id' => $_GET['id']
            ]);
            $results = $query->fetchAll()[0];
            $count = ceil($results['x'] / $perPage);
            ?>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($x = ($count - 4 < 1 ? 1 : $count - 4); $x < ($count + 1); $x++) : ?>
                        <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>><a href="/forum/post/<?php echo $rows[0]['id']; ?>/<?php echo $x; ?>"><?php echo $x; ?></a></li>
                    <?php endfor; ?>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php if ($logged_in) : ?>
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Antwoord toevoegen</h3>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="/includes/tools/berichtParse" method="post">
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
        codemirror: {
            theme: 'yeti'
        }
    });
</script>
</body>
</html>
<!-- https://twitter.com/DiscusHolland -->
