<?php
$levels = ["gebruiker", "lid"];
require_once("../../../includes/tools/security.php");

$stm = "SELECT * FROM `like` WHERE user_id = :user_id AND aquarium_id = :aquarium_id";
$res = $dbc->prepare($stm);
$res->execute([":user_id" => $_SESSION['user']->id, ":aquarium_id" => $_GET["aid"]]);
$user = $res->fetchAll(PDO::FETCH_ASSOC);

$contestSql = "SELECT * FROM contest WHERE start_at <= NOW() AND end_at >= NOW()";
$contestResult = $dbc->prepare($contestSql);
$contestResult->execute();
$contest = $contestResult->fetch();

if(sizeof($user) === 0)
{
    $sql = "INSERT INTO `like` (aquarium_id, user_id, created_at, contest_id) VALUES (:aid, :uid, NOW(), :cid)";
    $result = $dbc->prepare($sql);
    $result->execute([":aid" => $_GET['aid'], ":uid" => $_SESSION['user']->id, ":cid" => $contest['id']]);
}
else
{
    $sql = "DELETE FROM `like` WHERE user_id = :user_id AND aquarium_id = :aquarium_id";
    $result = $dbc->prepare($sql);
    $result->execute([":user_id" => $_SESSION['user']->id, ":aquarium_id" => $_GET["aid"]]);
}

header("Location: $_SERVER[HTTP_REFERER]");