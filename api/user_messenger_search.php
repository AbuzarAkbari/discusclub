<?php
require_once("../includes/tools/security.php");
require_once("../includes/tools/dbc.php");

$sth = $dbc->prepare("SELECT *, m.message, m.id, m.created_at FROM message as m JOIN user as u ON u.id = m.user_id_2 WHERE m.user_id_1 = :id OR m.user_id_2 = :id ORDER BY m.created_at DESC");
$sth->execute([":id" => $_GET["user_id"]]);
$res = $sth->fetchAll(PDO::FETCH_OBJ);
$id = isset($_GET["id"]) ? $_GET["id"] : $res[0]->user_id_2;
foreach ($res as $value) : ?>
    <?php if ($value->user_id_2 === $id) {
        $user = $value->first_name . " " . $value->last_name;
    } ?>
    <?php if($value->user_id_1 === $_GET["user_id"]) :?>
        <a href="/user/messenger/<?php echo $value->user_id_2; ?>">
            <div class="other">
                <div><img src="http://via.placeholder.com/350x150" class="otherUsers imageStatic"></div>
                <div class="usernameTab"><b><?php echo $value->first_name . " " . $value->last_name; ?></b></div>
                <div><?php echo implode(" ", array_slice(explode(" ", $value->message), 0, 5)) . "..."; ?></div>
            </div>
        </a>
    <?php endif; ?>
<?php endforeach; ?>