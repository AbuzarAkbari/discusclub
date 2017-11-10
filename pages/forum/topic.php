<?php
$levels = ["gebruiker", "lid"];
require_once("../../includes/tools/security.php");

$categorieenSql = "SELECT * FROM category";
$categorieenResult = $dbc->prepare($categorieenSql);
$categorieenResult->execute();
$results = $categorieenResult->fetchAll(PDO::FETCH_ASSOC);

//Pagination variables
$page = intval(isset($_GET['pagina']) ? $_GET['pagina'] : 1);
$perPage = 10;
$offset = $page * $perPage - $perPage;

//Select query for sub_category, topics, users, replies and roles
$sql = "SELECT *, user.id AS user_id, role.name AS role_name, user.created_at AS user_created_at, topic.id as topic_id, topic.content AS topic_content, topic.created_at AS topic_created_at, sub_category.id AS sub_category_id, sub_category.name AS sub_category_name FROM topic LEFT JOIN sub_category ON topic.sub_category_id = sub_category.id LEFT JOIN user ON topic.user_id = user.id LEFT JOIN image ON user.profile_img = image.id LEFT JOIN role ON user.role_id = role.id WHERE topic.id = :id ORDER BY topic.last_changed";
$result = $dbc->prepare($sql);
$result->execute([":id" => $_GET["id"]]);
$rows = $result->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="shortcut icon" href="/favicon.ico" />
    <title>Discusclub Holland</title>

    <!-- custom css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/nieuws.css">

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
    ;(function(d, s, id) {
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
    <div class="row columns">
        <div class="col-md-12">
                <div class="">
                    <?php
                        $sub_categorieen = "SELECT * FROM sub_category WHERE id = ?";
                        $subResult = $dbc->prepare($sub_categorieen);
                        $subResult->bindParam(1, $_GET['id']);
                        $subResult->execute();
                        $results2 = $subResult->fetchAll(PDO::FETCH_ASSOC);

                        if($results2){
                            $sql = "SELECT *, topic.id, topic.last_changed AS topic_last_changed FROM topic JOIN user as u ON u.id = topic.user_id WHERE sub_category_id = :id AND state_id = 3 AND topic.deleted_at IS NULL ORDER BY topic.last_changed DESC LIMIT {$perPage} OFFSET {$offset}";
                            $result = $dbc->prepare($sql);
                            $result->execute([":id" => $_GET["id"]]);
                            $results3 = $result->fetchAll(PDO::FETCH_ASSOC);

                            $sql = "SELECT *, topic.id, topic.last_changed AS topic_last_changed FROM topic JOIN user as u ON u.id = topic.user_id WHERE sub_category_id = :id AND state_id <> 3 AND topic.deleted_at IS NULL ORDER BY topic.last_changed DESC LIMIT {$perPage} OFFSET {$offset}";
                            $result = $dbc->prepare($sql);
                            $result->execute([":id" => $_GET["id"]]);
                            $results3 = array_merge($results3, $result->fetchAll(PDO::FETCH_ASSOC));
                        }
                    ?>
                    <br><br>
                </div>
        <br>
        <?php if(!$results2) :?>
            <div class="message error">Deze pagina bestaat niet, <a href="/forum/"> ga terug</a></div>
        <?php else : ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/forum/">Forum</a></li>
                <?php if ($results2): ?>
                    <li class="active"><?php echo $results2[0]['name']; ?></li>
                <?php endif; ?>
            </ol>
            <div class="panel panel-primary ">
                <?php foreach ($results2 as $subRow) : ?>
                <div class="panel-heading border-colors"><?php echo $subRow['name']; ?></div>
            <?php endforeach; ?>
                <div class="panel-body padding-padding table-responsive">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Titel</th>
                            <th>Auteur</th>
                            <th>Berichten</th>
                            <th>Bekeken</th>
                            <th>Laatste bericht</th>
                            <?php if (in_array($current_level, $admin_levels)) : ?>
                                <th>Admin tools</th>
                            <?php endif; ?>
                        </tr>
                        <?php foreach ($results3 as $topic) : ?>
                            <?php
                                $sql3 = "SELECT COUNT(id) AS i FROM reply WHERE topic_id = ? AND reply.deleted_at IS NULL";
                                $result3 = $dbc->prepare($sql3);
                                $result3->bindParam(1, $topic['id']);
                                $result3->execute();
                                $i = $result3->fetchAll(PDO::FETCH_ASSOC);

                                $x_berichten = $i[0]['i'] +1;


                                $sql4 = "SELECT COUNT(id) AS x FROM view WHERE topic_id = ?";
                                $result4 = $dbc->prepare($sql4);
                                $result4->bindParam(1, $topic['id']);
                                $result4->execute();
                                $x = $result4->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                                <td>
                                <?php
                                switch ($topic['state_id']) {
                                case 1:
                                    echo "<span class='glyphicon glyphicon-file'></span>";
                                    break;
                                case 2:
                                    echo "<span class='glyphicon glyphicon-lock'></span>";
                                    break;
                                case 3:
                                    echo "<span class='glyphicon glyphicon-pushpin'></span>";
                                    break;
                                }
                                    ?>
                                </td>
                                <td><a href="/forum/post/<?php echo $topic['id']; ?>"><?php echo $topic['title']; ?></a></td>
                                <td><a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>
                                <td><?php echo $x_berichten; ?></td>
                                <td><?php echo $x[0]['x']; ?></td>
                                <?php
                                    $userResult = $dbc->prepare("SELECT *, u.id as user_id, r.last_changed FROM reply as r JOIN topic as t ON t.id = r.topic_id JOIN user as u ON u.id = r.user_id WHERE t.id = :id ORDER BY r.last_changed DESC LIMIT 1 ");
                                    $userResult->execute([":id" => $topic["id"]]);
                                    $user = $userResult->fetch(PDO::FETCH_ASSOC);
                                    if($user) :
                                ?>
                                    <td><?php echo $topic['topic_last_changed']; ?>, <br> Door <a href="/user/<?php echo $user["user_id"]; ?>"><?php echo $user['first_name'].' '.$user['last_name']; ?></a></td>
                                    <?php else : ?>
                                    <td><?php echo $topic['topic_last_changed']; ?>, <br> Door <a href="/user/<?php echo $topic["user_id"]; ?>"><?php echo $topic['first_name'].' '.$topic['last_name']; ?></a></td>
                                    <?php endif;if (in_array($current_level, $admin_levels)) : ?>
                                <td>
                                    <a  title="Open" href="/includes/tools/topic/default.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $subRow['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-file"></i></a>
                                    <a  title="Pinnen" href="/includes/tools/topic/pin.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $subRow['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-pushpin"></i></a>
                                    <a  title="Locken" href="/includes/tools/topic/lock.php?id=<?php echo $topic['id']; ?>&sub_id=<?php echo $subRow['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-lock" ></i></a>
                                    <a title="Bewerken" href="/includes/tools/topic/edit.php?id=<?php echo $topic['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-edit" ></i></a>
                                    <a title="Verwijderen" href="/includes/tools/topic/del.php?id=<?php echo $topic['id']; ?>" type="button" class="btn btn-primary " name="button"> <i class="glyphicon glyphicon-remove-sign" ></i></a>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination system -->
    <div class="col-xs-12">

        <?php
            $query = $dbc->prepare('SELECT COUNT(*) AS x FROM topic WHERE sub_category_id = :id AND topic.deleted_at IS NULL');
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
                        <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>>
                            <a href="/forum/topic/<?php echo $rows['topic_id']; ?>/<?php echo $x; ?>"><?php echo $x; ?></a>
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

    <?php if ($logged_in && $results2) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Topic toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/forum/add-topic" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="add_topic_title" minlength="3" maxlength="50" placeholder="Topic Titel (max. 50 tekens)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea required class="form-control editor" col="8" rows="8" name="add_topic_content"
                                          style="resize: none !important;" placeholder="Uw bericht.."></textarea>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="hidden" name="subId" value="<?php echo $_GET['id']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" class="form-control" name="post_add_topic"
                                       value="Toevoegen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    </div>
        </div>
    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- summernote js -->
    <script type="text/javascript" src="/js/summernote.min.js"></script>
    <script src="/js/summernote-ext-emoji-min.js"></script>
    <script>document.emojiSource = '/images/'; //relative path to emojis</script>
    <script>
        $('.editor').summernote({
        	toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['font', ['strikethrough', 'superscript', 'subscript']],
			    ['fontsize', ['fontsize']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']],
			    ['misc', ['emoji']],
				['code', ['codeview']]
			  ],
      
            disableResizeEditor: true,
            codemirror: {
                theme: 'yeti'
            }

        });
    </script>
</body>
</html>
