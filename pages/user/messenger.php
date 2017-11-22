<?php
$levels = ["lid", "gebruiker"];
require_once("../../includes/tools/security.php");
require_once("../../includes/tools/messenger_handler.php");
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
    <br><br>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="/user/">Gebruiker</a></li>
                        <li class="active">Chat</li>
                    </ol>
                </div></div>
            <div class="col-md-4">
                <div class="userTab">
                    <img alt="Profielfoto" src="/images<?php echo $_SESSION["user"]->profile_img; ?>" class="imgUser imageStatic" />
                    <div class="username"><b> <?php echo $_SESSION["user"]->first_name . " " . $_SESSION["user"]->last_name; ?></b></div>
                </div>
                <div id="userTable" class="otherTab flexcroll">
                    <?php
                    $bindings = [":user_1" => $_SESSION["user"]->id];
                    if(isset($_POST["user_search"]) && !empty($_POST["user_search"])) {
                        $query = 1;
                        $bindings[":search"] = isset($_POST["user_search"]) ? "%" . $_POST["user_search"] . "%" : "%";
                        $bindings[":user_2"] = isset($_GET["id"]) ? $_GET["id"] : $_SESSION["user"]->id;
                        // $sth = $dbc->prepare("SELECT *, u.id FROM user AS u JOIN image AS i ON i.id = u.profile_img WHERE u.id <> :user_1 AND (u.first_name LIKE :search OR u.last_name LIKE :search OR u.username LIKE :search)");
                        $sth = $dbc->prepare("SELECT *, u.username AS user_1_username, u2.username AS user_2_username, i.path as user_1_path, i2.path as user_2_path, u.first_name as user_1_first_name, u.last_name AS user_1_last_name, u2.first_name as user_2_first_name, u2.last_name AS user_2_last_name, m.message, m.id, m.created_at, u.id AS user_1_id, u2.id AS user_2_id FROM user as u LEFT JOIN message as m ON u.id = m.user_id_1 LEFT JOIN user as u2 ON u2.id = m.user_id_2 LEFT JOIN image as i ON i.id = u.profile_img LEFT JOIN image as i2 ON i2.id = u2.profile_img WHERE u.id <> :user_1 AND (u.first_name LIKE :search OR u.last_name LIKE :search OR u.username LIKE :search OR CONCAT(u.first_name, \" \", u.last_name) LIKE :search) GROUP BY u.id ORDER BY m.created_at ASC");
                    } else {
                        $query = 2;
                        $sth = $dbc->prepare("SELECT *, u.username AS user_1_username, u2.username AS user_2_username, i.path as user_1_path, i2.path as user_2_path, u.first_name as user_1_first_name, u.last_name AS user_1_last_name, u2.first_name as user_2_first_name, u2.last_name AS user_2_last_name, m.message, m.id, m.created_at, u.id AS user_1_id, u2.id AS user_2_id FROM message AS m LEFT JOIN user AS u ON u.id = m.user_id_1 LEFT JOIN user as u2 ON u2.id = m.user_id_2 LEFT JOIN image AS i ON i.id = u.profile_img LEFT JOIN image as i2 ON u2.profile_img = i2.id WHERE u.id IN (:user_1) OR u2.id IN (:user_1) GROUP BY u.id, u2.id ORDER BY m.created_at ASC");
                    }
                    $sth->execute($bindings);
                    $res = $sth->fetchAll(PDO::FETCH_OBJ);
                    // remove doubles
                    $users = [];
                    $res = array_filter($res, function($x) use (&$users) {
                        $user = $_SESSION["user"]->id === $x->user_id_1;
                        $username = $user ? $x->user_2_username : $x->user_1_username;
                        if(isset($users[$username])) {
                            return false;
                        } else {
                            $users[$username] = true;
                            return true;
                        }
                    });
                    $id = isset($res[0]) ? $res[0]->user_id_2 : 0;
                    $id = isset($_GET["id"]) ? $_GET["id"] : $id;
                    $found = false;
                    $ids = [];
                    foreach($res as $r) {
                        if($r->user_1_id == $id || $r->user_2_id == $id) {
                            $found = true;
                        }
                        $ids[] = $r->user_1_id;
                        $ids[] = $r->user_2_id;
                    }

                    if((sizeof($res) === 0 && $query === 2 && $id != 0) || !$found) {
                        $sth = $dbc->prepare("SELECT *, u.username AS user_1_username, u2.username AS user_2_username, i.path as user_1_path, i2.path as user_2_path, u.first_name as user_1_first_name, u.last_name AS user_1_last_name, u2.first_name as user_2_first_name, u2.last_name AS user_2_last_name, m.message, m.id, m.created_at, u.id AS user_1_id, u2.id AS user_2_id FROM user AS u LEFT JOIN message AS m ON u.id = m.user_id_1 LEFT JOIN user as u2 ON u2.id = m.user_id_2 LEFT JOIN image AS i ON i.id = u.profile_img LEFT JOIN image as i2 ON u2.profile_img = i2.id WHERE (u.id IN (:user_1) OR u2.id IN (:user_1)) GROUP BY u.id, u2.id ORDER BY m.created_at DESC");
                        $sth->execute([":user_1" => $id, ":notIn" => implode($ids)]);
                        $res = array_merge($sth->fetchAll(PDO::FETCH_OBJ), $res);
                    }

                    $id = isset($_GET["id"]) ? $_GET["id"] : $res[0]->user_id_2;
                    $amount_of_items = false;
                    if(sizeof($res) > 0) {
                        $amount_of_items = true;
                    }
                    foreach ($res as $value) : ?>
                        <?php
                        $user = $_SESSION["user"]->id === $value->user_id_1;
                        $sth = $dbc->prepare("SELECT m.message FROM message as m WHERE user_id_1 IN (:user_1, :user_2) AND user_id_2 IN (:user_1, :user_2) ORDER BY m.created_at DESC LIMIT 1");
                        $sth->execute([":user_1" => $_SESSION["user"]->id, ":user_2" => $user ? $value->user_2_id : $value->user_1_id]);
                        $last_message = $sth->fetch(PDO::FETCH_OBJ)->message;
                        ?>
                        <a href="/user/messenger/<?php echo $user ? $value->user_2_id : $value->user_1_id; ?>">
                            <div class="other">
                                <div><img alt="profielfoto" src="/images<?php echo $user ? $value->user_2_path : $value->user_1_path; ?>" class="otherUsers imageStatic"></div>
                                <div class="usernameTab"><b><?php echo $user ? $value->user_2_first_name . " " . $value->user_2_last_name : $value->user_1_first_name . " " . $value->user_1_last_name; ?></b></div>
                                <?php if(!empty($last_message)) : ?>
                                    <div><?php echo substr($last_message, 0, 25) . "..."; ?></div>
                                <?php endif;  ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <form class="" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                    <div class="searchUser input-group inputWidth">
                        <input type="text" class="form-control" name="user_search" placeholder="" >
                    </div>
                </form>
            </div>
            <?php
            $sth = $dbc->prepare("SELECT *, mi.path AS message_image, i.path as user_1_path, i2.path as user_2_path, u.first_name as user_1_first_name, u.last_name AS user_1_last_name, u2.first_name as user_2_first_name, u2.last_name AS user_2_last_name, u.id FROM user as u JOIN message as m ON m.user_id_1 = u.id JOIN image as i ON i.id = u.profile_img JOIN user as u2 ON m.user_id_2 = u2.id JOIN image as i2 ON i2.id = u2.profile_img LEFT JOIN image AS mi ON mi.id = m.image_id WHERE u.id IN (:user_1, :user_2) AND u2.id IN (:user_1, :user_2) ORDER BY m.created_at");
            $sth->execute([":user_1" => $_SESSION["user"]->id, ":user_2" => $id]);
            $res = $sth->fetchAll(PDO::FETCH_OBJ);
            if(!$res) {
                $sth = $dbc->prepare("SELECT *, i.path as user_1_path, u.first_name as user_1_first_name, u.last_name AS user_1_last_name, u.id FROM user as u JOIN image as i ON i.id = u.profile_img WHERE u.id IN (:user_1) ORDER BY m.created_at");
                $sth->execute([":user_1" => $id]);
                $res = $sth->fetchAll(PDO::FETCH_OBJ);
            }
            if(isset($res[0]->user_id_2)) {
                $user = $_SESSION["user"]->id === $res[0]->user_id_2;
            } else {
                $user = true;
            }
            ?>
            <div class="col-md-8">
                <?php if($amount_of_items && $res) :  ?>
                <div class="userTab">
                    <img alt="profielfoto" src="/images<?php echo $user ? $res[0]->user_1_path : $res[0]->user_2_path; ?>" class="imgUser imageStatic" />
                    <div class="username"><b> <?php echo $user ? $res[0]->user_1_first_name . " " . $res[0]->user_1_last_name : $res[0]->user_2_first_name . " " . $res[0]->user_2_last_name; ?></b></div>
                </div>
                <?php endif; ?>
                <div id="message" style="background-image: url('/images<?php echo $_SESSION["user"]->messenger_img; ?>');<?php echo !$amount_of_items || !$res ? "height: 590px; max-height: 590px;" : null; ?>" class="imageBackgroundText flexcroll tab">
                    <?php foreach ($res as $value) : ?>
                        <?php if(isset($value->message)) : ?>
                            <div class="messages <?php echo $value->user_id_1 === $_SESSION["user"]->id ? "right-message" : "left-message" ?>">
                                <div><?php echo $value->message; ?></div>
                                <?php if(isset($value->message_image)) : ?>
                                <div><img src="/images<?php echo $value->message_image; ?>" alt="afbeelding"></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php if($amount_of_items && $res) : ?>
                <div class="searchUser">
                    <form enctype='multipart/form-data' class="inputWidth" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="input-group">
                      <div class="input-group inputWidth">
                        <input name="message" type="text" class="form-control inputWidth" placeholder="">
                        <span class="input-group-btn">

                            <div class="upload">
                                <label for="file"></label>
                                <input id="file" type="file" name="upload" />
                            </div>
                        </span>
                        <span class="input-group-btn">

                            <div class="upload-arrow">
                                <label for="arrow"></label>
                                <input id="arrow" type="submit" name="upload" />
                            </div>
                        </span>
                      </div>
                      <input type="hidden" name="user_id_2" value="<?php echo $id; ?>" />
                    </form>
                </div>
                <?php endif; ?>
                </div>
            </div>
            <br>
            <?php require ('../../includes/components/advertentie.php'); ?>
        </div>

    <footer>
<?php require_once("../../includes/components/footer.php") ; ?>
    </footer>
    <!-- bootstrap script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(".tab").animate({ scrollTop: $(document).height() });
    </script>
</body>
</html>
