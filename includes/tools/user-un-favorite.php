<?php
require_once("../../includes/tools/security.php");

if($logged_in) {
    $user_id = $_SESSION['user']->id;
    $topic_id = $_GET['id'];

    $sql = "DELETE FROM favorite WHERE user_id = :user_id";
    $result = $dbc->prepare($sql);
    $result->execute([":user_id" => $user_id]);

    header("Location: /forum/post/".$topic_id);
}